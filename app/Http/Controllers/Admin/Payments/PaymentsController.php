<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function getUserPaymentssWithDetails(): array|Response
    {
        $userId = Auth::id();

        $payments = Payment::where('user_id', $userId)
            ->with([
                'order'
            ])
            ->get();

        return $payments->toArray();
    }


    /**
     * Récupérer tous les orders liés à un shop.
     */
    public function getPaymentsByShop()
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
        $payments = Payment::whereHas('order.orderItems.product', function ($query) use ($shop) {
            $query->where('shop_id', $shop->id);
        })->with(['order.orderItems.product.shop', 'user'])->get();

        return response()->json($payments, 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'payment_date' => 'sometimes',
            'payment_method' => 'required|string',
            'user_id' => 'nullable',
        ]);

        return response()->json([
            'payment' => Payment::create($data),
            'message' => 'successfully payment'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
