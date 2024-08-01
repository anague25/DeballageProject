<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Contracts\Orders\OrderServiceContract;
use App\Http\Requests\Orders\OrdersStoreRequest;
use App\Http\Requests\Orders\OrdersUpdateRequest;

class OrderController extends Controller
{
    private $ordersService;

    public function __construct(OrderServiceContract $ordersService)
    {
        $this->ordersService = $ordersService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->ordersService->index();
    }


    public function getUserOrders()
    {
        return $this->ordersService->getUserOrdersWithDetails();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrdersStoreRequest $request)
    {
        // dd($request->validated());
        return  $this->ordersService->create($request->validated());
    }

    /**
     * Display the specified order.
     * 
     */
    public function show(Order $order)
    {
        return $this->ordersService->show($order);
    }

    /**
     * Display the specified order.
     * 
     */
    public function getOrdersByShop()
    {
        return $this->ordersService->getOrdersByShop();
    }

    /**
     * Update the specified order in storage.
     */
    public function update(OrdersUpdateRequest $request, Order $order)
    {
        return $this->ordersService->update($order, $request->validated());
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        return $this->ordersService->delete($order);
    }

    public function associateOrder($token)
    {
        return $this->ordersService->associateOrder($token);
    }
}
