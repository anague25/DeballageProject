<?php

namespace App\Contracts\Orders;

use App\Models\Order;

interface OrderServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Order $order
     */
    public function show(Order $order);



    public function getOrdersByShop();


    public function index();

    public function getUserOrdersWithDetails();

    /**
     * @param Order $order
     * @param array $data
     */
    public function update(Order $order, array $data);


    /**
     * @param Order $order
     */
    public function delete(Order $order);

    /**
     * @param string $token
     */
    public function associateOrder($token);
}
