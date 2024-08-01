<?php

namespace App\Services\Favorites;

use App\Models\Favorite;
use Illuminate\Http\Response;
use App\Contracts\Favorites\FavoriteServiceContract;
use App\Http\Resources\Favorites\FavoritesResource;
use App\Http\Resources\Favorites\FavoritesCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoritesServices implements FavoriteServiceContract
{

    /**
     * create an favorite
     * 
     * @param array $data.
     * @return FavoritesResource.
     */
    public function create($data): FavoritesResource|JsonResponse
    {
        $user = Auth::user();
        $existingFavorite = $user->favorites()
            ->where('favoritable_type', $data['favoritable_type'])
            ->where('favoritable_id', $data['favoritable_id'])
            ->first();

        if ($existingFavorite) {
            // Retourner une erreur ou un message indiquant que le favori existe déjà
            // Vous pouvez personnaliser la réponse selon vos besoins
            return response()->json(['message' => 'This element already added on favorite'], 403);
        }

        $favorite = $user->favorites()->create($data);
        return new FavoritesResource($favorite);
    }

    public function removeFavorite($id)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est authentifié
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $favorite = Favorite::where('favoritable_id', $id)->first();
        $favorite->delete();
        return response()->json(['message' => 'Successfully removed on your favorite'], 201);
    }

    /**
     * update an favorite
     * 
     * @param Favorite $favorite.
     * @return FavoritesResource.
     */
    public function update(Favorite $favorite, array $data): FavoritesResource
    {
        $favorite->update($data);
        return new FavoritesResource($favorite);
    }


    /**
     * get all $Favorites
     * 
     * @return array.
     */

    // public function index(): FavoritesCollection|JsonResponse
    // {
    //     $user = Auth::user();
    //     $favorites = $user->favorites;
    //     return new FavoritesCollection($favorites);
    // }

    /**
     * Récupère tous les favoris de l'utilisateur connecté avec les détails des produits ou des boutiques.
     *
     * @return array|Response
     */
    public function index(): array|Response
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est authentifié
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Récupérer tous les favoris de l'utilisateur avec les détails des produits ou des boutiques
        $favorites = $user->favorites()->with('favoritable')->get();

        // Préparer les données à retourner
        $formattedFavorites = $favorites->map(function ($favorite) {
            $favoritable = $favorite->favoritable;

            if ($favoritable instanceof \App\Models\Product) {
                $favoritable->load('category');
                return [
                    'type' => 'product',
                    'id' => $favoritable->id,
                    'shop_id' => $favoritable->shop_id,
                    'name' => $favoritable->name,
                    'image' => $favoritable->image,
                    'quantity' => $favoritable->quantity,
                    'price' => $favoritable->price,
                    'description' => $favoritable->description,
                    'status' => $favoritable->status,
                    'category' => [
                        'id' => $favoritable->category->id,
                        'name' => $favoritable->category->name,
                        'description' => $favoritable->category->description,
                        'image' => $favoritable->category->image,
                    ],
                    'category_id' => $favoritable->category_id,
                    'created_at' => $favoritable->created_at,
                    'updated_at' => $favoritable->updated_at,
                    // Ajouter d'autres attributs spécifiques aux produits
                ];
            } elseif ($favoritable instanceof \App\Models\Shop) {
                return [
                    'type' => 'shop',
                    'id' => $favoritable->id,
                    'name' => $favoritable->name,
                    'description' => $favoritable->description,
                    'state' => $favoritable->state,
                    'profile' => $favoritable->profile,
                    'cover' => $favoritable->cover,
                    'created_at' => $favoritable->created_at,
                    'updated_at' => $favoritable->updated_at,
                    // Ajouter d'autres attributs spécifiques aux boutiques
                ];
            }

            // Retourner null ou gérer d'autres types d'entités selon votre cas
            return null;
        });




        // dd($formattedFavorites->toArray());

        // Retourner les données formatées
        return $formattedFavorites->toArray();
    }

    // Autres méthodes du service


    /**
     * get an favorite
     * @param Favorite $favorite
     * @return FavoritesResource.
     */

    public function show(Favorite $favorite): FavoritesResource
    {
        return new FavoritesResource($favorite);
    }



    /**
     * delete an favorite
     * 
     * @param Favorite $favorite.
     * @return Illuminate\Http\Response.
     */

    public function delete(Favorite $favorite): Response
    {
        $favorite->delete();

        return response()->noContent();
    }
}
