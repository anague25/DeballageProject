<?php

namespace App\Http\Controllers\Admin\User\Auth;

use App\Models\Property;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{

    /**
     * Handle the incoming request.
     */

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function __invoke()
    {
        $user = Auth::user();
        if ($user->shop) {
            // Charger l'utilisateur avec les relations nécessaires
            $user->load([
                'shop.products.category',
                'shop.products.attributes' => function ($query) {
                    // Charger la relation attributes avec une jointure conditionnelle pour récupérer properties
                    $query->leftJoin('properties', function ($join) {
                        $join->on('attribute_product.property_id', '=', 'properties.id');
                    })
                        ->select('attributes.*', 'properties.*', 'attribute_product.property_id as pivot_property_id');
                },

                'shop.cities.pivotNeighborhoods',
            ]);
            // Manipuler les relations chargées pour ne garder que la propriété spécifiée par property_id
            foreach ($user->shop->products as $product) {
                foreach ($product->attributes as $attribute) {
                    // Filtrer les propriétés pour ne garder que celle spécifiée par property_id
                    if ($attribute->pivot->property_id) {
                        $attribute->properties = Property::where('id', $attribute->pivot->property_id)->first();
                    } else {
                        $attribute->properties = null;
                    }
                }
            }


            // Filtrer les quartiers pour chaque ville du magasin
            foreach ($user->shop->cities as $city) {
                if ($city->pivotNeighborhoods) {
                    // Filtrer les quartiers pour ne garder que ceux associés à ce magasin et à cette ville
                    $filteredNeighborhoods = $city->pivotNeighborhoods->filter(function ($neighborhood) use ($user) {
                        return $neighborhood->pivot && $neighborhood->pivot->shop_id == $user->shop->id;
                    })->unique('id')->values();

                    // Remplacer la collection de quartiers pivotés par la collection filtrée
                    $city->setRelation('pivotNeighborhoods', $filteredNeighborhoods);
                }
            }
        }
        return response()->json($user);
    }
}
