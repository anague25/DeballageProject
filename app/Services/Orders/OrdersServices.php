<?php

namespace App\Services\Orders;

use App\Models\Order;
use Illuminate\Http\Response;
use App\Contracts\Orders\OrderServiceContract;
use App\Http\Resources\Orders\OrdersResource;
use App\Http\Resources\Orders\OrdersCollection;

class OrdersServices implements OrderServiceContract
{

    /**
     * create an order
     * 
     * @param array $data.
     * @return OrdersResource.
     */
    public function create($data): OrdersResource
    {
        return new OrdersResource(Order::create($data));
    }

    /**
     * update an order
     * 
     * @param Order $order.
     * @return OrdersResource.
     */
    public function update(Order $order, array $data): OrdersResource
    {
        $order->update($data);
        return new OrdersResource($order);
    }


    /**
     * get all orders
     * 
     * @return array.
     */

    public function index(): OrdersCollection
    {

        return new OrdersCollection(Order::all());
    }


    /**
     * get an order
     * @param Order $order
     * @return OrdersResource.
     */

    public function show(Order $order): OrdersResource
    {
        return new OrdersResource($order);
    }



    /**
     * delete an order
     * 
     * @param Order $order.
     * @return Illuminate\Http\Response.
     */

    public function delete(Order $order): Response
    {
        $order->delete();

        return response()->noContent();
    }
}
