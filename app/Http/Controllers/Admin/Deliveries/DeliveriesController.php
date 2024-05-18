<?php

namespace App\Http\Controllers\Admin\Deliveries;

use App\Models\Delivery;
use App\Http\Controllers\Controller;
use App\Contracts\Deliveries\DeliveryServiceContract;
use App\Http\Requests\Deliveries\DeliveriesStoreRequest;
use App\Http\Requests\Deliveries\DeliveriesUpdateRequest;

class DeliveriesController extends Controller
{
    private $deliveriesService;

    public function __construct(DeliveryServiceContract $deliveriesService)
    {
        $this->deliveriesService = $deliveriesService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->deliveriesService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveriesStoreRequest $request)
    {
        return  $this->deliveriesService->create($request->validated());
    }

    /**
     * Display the specified delivey.
     * 
     */
    public function show(Delivery $delivey)
    {
        return $this->deliveriesService->show($delivey);
    }

    /**
     * Update the specified delivey in storage.
     */
    public function update(DeliveriesUpdateRequest $request, Delivery $delivey)
    {
        return $this->deliveriesService->update($delivey, $request->validated());
    }

    /**
     * Remove the specified delivey from storage.
     */
    public function destroy(Delivery $delivey)
    {
        return $this->deliveriesService->delete($delivey);
    }
}
