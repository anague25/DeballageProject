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


    public function index();

    /**
     * @param Order $order
     * @param array $data
     */
    public function update(Order $order, array $data);


    /**
     * @param Order $order
     */
    public function delete(Order $order);
}
