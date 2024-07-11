<?php

namespace App\Services\Orders;

use App\Models\Order;
use Illuminate\Http\Response;
use App\Contracts\Orders\OrderServiceContract;
use App\Http\Resources\Orders\OrdersResource;
use App\Http\Resources\Orders\OrdersCollection;
use Illuminate\Support\Facades\Auth;

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
        // dd($data);

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


    public function associateOrder($token)
    {
        $order = Order::where('token', $token)->firstOrFail();

        // Vérifier si l'utilisateur est authentifié, Vérifier que le token est valide pour cette commande et qu'elle n'est pas encore associée
        if (auth()->check() && $order->user_id === null && $order->token === $token) {
            $this->associateOrderWithUser($order);
            return response()->json(['message' => 'Order associated successfully.']);
        } else {
            return response()->json(['message' => 'Invalid order token or order already associated.'], 403);
        }

        return response()->json(['redirect' => route('login')]);
    }



    public function associateOrderWithUser(Order $order)
    {
        if (auth()->check()) {
            $order->update(['user_id' => auth()->id()]);
        }
    }
}
