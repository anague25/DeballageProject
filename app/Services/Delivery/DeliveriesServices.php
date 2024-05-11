<?php

namespace App\Services\Deliveries;

use App\Models\Deliveries;
use Illuminate\Http\Response;
use App\Contracts\Deliveries\DeliveryserviceContract;
use App\Http\Resources\Deliveries\DeliveriesResource;
use App\Http\Resources\Deliveries\DeliveriesCollection;
use App\Models\Delivery;

class DeliveriesServices implements DeliveryserviceContract
{

    /**
     * create an $delivery
     * 
     * @param array $data.
     * @return DeliveriesResource.
     */
    public function create($data): DeliveriesResource
    {
        return new DeliveriesResource(Delivery::create($data));
    }

    /**
     * update an $delivery
     * 
     * @param Deliveries $delivery.
     * @return DeliveriesResource.
     */
    public function update(Delivery $delivery, array $data): DeliveriesResource
    {
        $delivery->update($data);
        return new DeliveriesResource($delivery);
    }


    /**
     * get all $Deliveries
     * 
     * @return array.
     */

    public function index(): DeliveriesCollection
    {

        return new DeliveriesCollection(Delivery::all());
    }


    /**
     * get an $delivery
     * @param Deliveries $delivery
     * @return DeliveriesResource.
     */

    public function show(Delivery $delivery): DeliveriesResource
    {
        return new DeliveriesResource($delivery);
    }



    /**
     * delete an $delivery
     * 
     * @param Deliveries $delivery.
     * @return Illuminate\Http\Response.
     */

    public function delete(Delivery $delivery): Response
    {
        $delivery->delete();

        return response()->noContent();
    }
}
