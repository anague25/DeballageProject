<?php

namespace App\Http\Controllers\Admin\OrderItems;

use App\Contracts\OrderItems\OrderItemServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderItems\OrderItemsStoreRequest;
use App\Http\Requests\OrderItems\OrderItemsUpdateRequest;
use App\Models\OrderItem;

class OrderItemsController extends Controller
{
    private $orderItemsService;

    public function __construct(OrderItemServiceContract $orderItemsService)
    {
        $this->orderItemsService = $orderItemsService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->orderItemsService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderItemsStoreRequest $request)
    {
        return  $this->orderItemsService->create($request->validated());
    }

    /**
     * Display the specified order.
     * 
     */
    public function show(OrderItem $order)
    {
        return $this->orderItemsService->show($order);
    }

    /**
     * Update the specified order in storage.
     */
    public function update(OrderItemsUpdateRequest $request, OrderItem $order)
    {
        return $this->orderItemsService->update($order, $request->validated());
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(OrderItem $order)
    {
        return $this->orderItemsService->delete($order);
    }
}
