<?php

namespace App\Contracts\OrderItems;

use App\Models\Order;
use App\Models\OrderItem;

interface OrderItemServiceContract
{

    /**
     * @param array $data
     */
    public function create(Order $order, array $data);


    /**
     * @param OrderItem $orderItem
     */
    public function show(OrderItem $orderItem);


    public function index();

    /**
     * @param OrderItem $orderItem
     * @param array $data
     */
    public function update(OrderItem $orderItem, array $data);


    /**
     * @param OrderItem $orderItem
     */
    public function delete(OrderItem $orderItem);
}
