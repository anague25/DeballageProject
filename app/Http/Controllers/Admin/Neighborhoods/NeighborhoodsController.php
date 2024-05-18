<?php

namespace App\Http\Controllers\Admin\Neighborhoods;

use App\Models\Neighborhood;
use App\Http\Controllers\Controller;
use App\Contracts\Neighborhoods\NeighborhoodServiceContract;
use App\Http\Requests\Neighborhood\NeighborhoodStoreRequest;
use App\Http\Requests\Neighborhood\NeighborhoodUpdateRequest;

class NeighborhoodsController extends Controller
{
    private $neighborhoodsService;

    public function __construct(NeighborhoodServiceContract $neighborhoodsService)
    {
        $this->neighborhoodsService = $neighborhoodsService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->neighborhoodsService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NeighborhoodStoreRequest $request)
    {
        return  $this->neighborhoodsService->create($request->validated());
    }

    /**
     * Display the specified neighborhood.
     * 
     */
    public function show(Neighborhood $neighborhood)
    {
        return $this->neighborhoodsService->show($neighborhood);
    }

    /**
     * Update the specified neighborhood in storage.
     */
    public function update(NeighborhoodUpdateRequest $request, Neighborhood $neighborhood)
    {
        return $this->neighborhoodsService->update($neighborhood, $request->validated());
    }

    /**
     * Remove the specified neighborhood from storage.
     */
    public function destroy(Neighborhood $neighborhood)
    {
        return $this->neighborhoodsService->delete($neighborhood);
    }
}
