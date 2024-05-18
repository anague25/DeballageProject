<?php

namespace App\Services\OrderItems;

use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Response;
use App\Mail\Order\SellerOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\OrderItems\OrderItemsResource;
use App\Contracts\OrderItems\OrderItemServiceContract;
use App\Http\Resources\OrderItems\OrderItemsCollection;

class OrderItemsServices implements OrderItemServiceContract
{

    /**
     * create an orderItem
     * 
     * @param array $data.
     * @return OrderItemsCollection.
     */
    public function create(Order $order,$validatedData): OrderItemsCollection
    {
        $orderItems = [];

        foreach ($validatedData as $itemData) {
            $orderItem = new OrderItem($itemData);
            $order->orderItems()->save($orderItem);
            $orderItems[] = $orderItem;
        }

        

        return new OrderItemsCollection(OrderItem::create($orderItems));
    }


    public function notifySellers($orderId)
    {
        $productItems = OrderItem::where('order_id', $orderId)->get();
        $productsByShop = $productItems->groupBy('shop_id');

        foreach ($productsByShop as $shopId => $items) {
            $shop = Shop::find($shopId);
            $sellerEmail = $shop->user->email;
            Mail::to($sellerEmail)->send(new SellerOrderMail($items));
        }
    }

    /**
     * update an OrderItem
     * 
     * @param OrderItem $OrderItem.
     * @return OrderItemsCollection.
     */
    public function update(array $validatedData): OrderItemsCollection
    {
        $updatedOrderItems = [];

    foreach ($validatedData as $itemData) {
        $orderItem = OrderItem::findOrFail($itemData['id']);
        $orderItem->update($itemData);
        $updatedOrderItems[] = $orderItem;
    }

        return new OrderItemsCollection($updatedOrderItems);
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
