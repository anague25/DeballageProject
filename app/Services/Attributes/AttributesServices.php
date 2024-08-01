<?php

namespace App\Services\Attributes;

use App\Models\Attribute;
use Illuminate\Http\Response;
use App\Contracts\Attributes\AttributeServiceContract;
use App\Http\Resources\Attributes\AttributesResource;
use App\Http\Resources\Attributes\AttributesCollection;
use Illuminate\Support\Facades\Auth;

class AttributesServices implements AttributeServiceContract
{

    /**
     * create an $attribute
     * 
     * @param array $data.
     * @return AttributesResource.
     */
    public function create($data): AttributesResource
    {
        return new AttributesResource(Attribute::create($data));
    }

    /**
     * update an $attribute
     * 
     * @param Attribute $attribute.
     * @return AttributesResource.
     */
    public function update(Attribute $attribute, array $data): AttributesResource
    {
        $attribute->update($data);
        return new AttributesResource($attribute);
    }


    /**
     * get all $attributes
     * 
     * @return array.
     */

    public function index(): AttributesCollection
    {

        // dd(request('query'));
        $attributes =  Attribute::query()->when(request('query'), function ($query, $searchQuery) {
            $query->where('name', 'like', "%{$searchQuery}%");
        })->latest()->paginate(5);
        return new AttributesCollection($attributes);
    }

    public function all(): AttributesCollection
    {
        return new AttributesCollection(Attribute::with('properties')->latest()->get());
    }


    /**
     * get an $attribute
     * @param Attribute $attribute
     * @return AttributesResource.
     */

    public function show(Attribute $attribute): AttributesResource
    {
        return new AttributesResource($attribute->load('properties'));
    }

    public function getAttributeUser()
    {
        $user = Auth::user();
        // dd($user);
        $attributes = Attribute::where('user_id', $user->id)->get();
        return response()->json(['attributes' => $attributes], 200);
    }



    /**
     * delete an $attribute
     * 
     * @param Attribute $attribute.
     * @return Illuminate\Http\Response.
     */

    public function delete(Attribute $attribute): Response
    {
        $attribute->products()->sync([]);
        foreach ($attribute->properties as $property) {
            $property->attribute()->dissociate();
            $property->save();
        }
        $attribute->delete();

        return response()->noContent();
    }
}
