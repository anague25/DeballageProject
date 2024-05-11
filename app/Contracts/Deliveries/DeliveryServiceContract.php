<?php

namespace App\Contracts\Deliveries;

use App\Models\Delivery;

interface DeliveryServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Delivery delivery
     */
    public function show(Delivery $attribute);


    public function index();

    /**
     * @param Delivery $delivery
     * @param array $data
     */
    public function update(Delivery $attribute, array $data);


    /**
     * @param Delivery $delivery
     */
    public function delete(Delivery $attribute);
}
