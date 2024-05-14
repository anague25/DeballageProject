<?php

namespace App\Contracts\OrderItems;

use App\Models\OrderItem;

interface OrderItemServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


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
