<?php

namespace App\Services\OrderItems;

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
    public function create(Order $order, $validatedData): OrderItemsCollection
    {
        $orderItems = [];
        foreach ($validatedData['items'] as $itemData) {
            $orderItem = new OrderItem($itemData);
            $order->orderItems()->save($orderItem);
            $orderItems[] = $orderItem;
        }


        // envoyer un mail a tous les vendeurs, le mail contient les differents p
        $this->notifySellers($order->id,$validatedData);

        return new OrderItemsCollection($orderItems);
    }


    public function notifySellers($orderId,$validatedData)
    {
        // Récupérer tous les OrderItems de la commande spécifiée
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        // Initialiser un tableau pour regrouper les OrderItems par vendeur
        $itemsBySeller = [];

        // Itérer sur chaque OrderItem pour regrouper par vendeur
        foreach ($orderItems as $orderItem) {
            // Accéder au produit associé à cet OrderItem
            $product = $orderItem->product;

            if ($product) {
                // Accéder au shop associé au produit
                $shop = $product->shop;

                if ($shop) {
                    // Récupérer l'email du vendeur du shop
                    $sellerEmail = $shop->user->email;

                    // Ajouter l'OrderItem au tableau correspondant au vendeur
                    if (!isset($itemsBySeller[$sellerEmail])) {
                        $itemsBySeller[$sellerEmail] = [];
                    }
                    $itemsBySeller[$sellerEmail][] = $orderItem;
                }
            }
        }

        // Envoyer un email à chaque vendeur avec les OrderItems regroupés
        foreach ($itemsBySeller as $sellerEmail => $items) {
            // dd($itemsBySeller);
            Mail::to($sellerEmail)->send(new SellerOrderMail($items,$validatedData));
        }
    }


    /**
     * update an OrderItem
     * 
     * @param OrderItem $OrderItem.
     * @return OrderItemsCollection.
     */
    public function update(OrderItem $orderItem, array $validatedData): OrderItemsResource
    {
        $orderItem->update($validatedData);

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
