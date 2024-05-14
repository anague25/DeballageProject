<?php

namespace App\Services\OrderItems;

use App\Models\OrderItem;
use Illuminate\Http\Response;
use App\Contracts\OrderItems\OrderItemServiceContract;
use App\Http\Resources\OrderItems\OrderItemsResource;
use App\Http\Resources\OrderItems\OrderItemsCollection;

class OrderItemsServices implements OrderItemServiceContract
{

    /**
     * create an orderItem
     * 
     * @param array $data.
     * @return OrderItemsResource.
     */
    public function create($data): OrderItemsResource
    {
        return new OrderItemsResource(OrderItem::create($data));
    }

    /**
     * update an OrderItem
     * 
     * @param OrderItem $OrderItem.
     * @return OrderItemsResource.
     */
    public function update(OrderItem $orderItem, array $data): OrderItemsResource
    {
        $orderItem->update($data);
        return new OrderItemsResource($orderItem);
    }


    /**
     * get all OrderItems
     * 
     * @return array.
     */

    public function index(): OrderItemsCollection
    {

        return new OrderItemsCollection(OrderItem::all());
    }


    /**
     * get an orderItem
     * @param OrderItem $orderItem
     * @return OrderItemsResource.
     */

    public function show(OrderItem $orderItem): OrderItemsResource
    {
        return new OrderItemsResource($orderItem);
    }



    /**
     * delete an orderItem
     * 
     * @param OrderItem $orderItem.
     * @return Illuminate\Http\Response.
     */

    public function delete(OrderItem $orderItem): Response
    {
        $orderItem->delete();

        return response()->noContent();
    }
}
