<?php

namespace App\Services\Orders;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Orders\OrdersResource;
use App\Contracts\Orders\OrderServiceContract;
use App\Http\Resources\Orders\OrdersCollection;
use App\Models\OrderItem;

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



    public function getUserOrdersWithDetails(): array|Response
    {
        $userId = Auth::id();

        $orders = Order::where('user_id', $userId)
            ->with([
                'orderItems.product.shop', // Charge les produits et les shops associés aux order items
                'orderItems.product.category', // Charge la catégorie associée aux produits
                'payment', // Charge les informations de paiement
                'deliveries' // Charge les informations de paiement
            ])
            ->get();

        return $orders->toArray();
    }


    // public function getOrdersShop(){
    //     $user = User::find(Auth::id());
    //     $shop = $user->shop;
    //     $orderItems = OrderItem::with('product')->get();
    // }


    /**
     * Récupérer tous les orders liés à un shop.
     */
    // public function getOrdersByShop()
    // {
    //     $user = User::find(Auth::id());
    //     $shop = $user->shop;
    //     $orders = Order::with(['orderItems.product', 'payment'])->get();
    //     $shopOrders = [];
    //     foreach ($orders as $order) {
    //         foreach ($order->orderItems as $item) {
    //             $product = $item->product;
    //             if ($product->shop_id === $shop->id) {
    //                 if (!in_array($order, $shopOrders)) {
    //                     $shopOrders[] = $order;
    //                 }
    //             }
    //         }
    //     }

    //     $shopOrders = collect($shopOrders);

    //     dd($shopOrders->toArray());

    //     // return response()->json($orders);
    // }



    /**
     * Récupérer tous les orders liés à un shop.
     */
    public function getOrdersByShop()
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = Auth::user();

        // Vérifier si l'utilisateur possède un shop
        if (!$user || !$user->shop) {
            return response()->json(['message' => 'Shop not found'], 404);
        }

        // Récupérer le shop de l'utilisateur
        $shop = $user->shop;

        // Récupérer les commandes liées aux produits du shop
        $orders = Order::whereHas('orderItems.product', function ($query) use ($shop) {
            $query->where('shop_id', $shop->id);
        })->with(['orderItems.product', 'payment', 'user', 'deliveries'])->get();

        return response()->json($orders, 200);
    }




    /**
     * get all orders
     * 
     * @return array.
     */

    public function index(): OrdersCollection
    {

        return new OrdersCollection(Order::paginate(15));
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
