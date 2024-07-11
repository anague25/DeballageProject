<?php

namespace App\Services\Deliveries;

use App\Models\Order;
use App\Models\Delivery;
use App\Models\Deliveries;
use Illuminate\Http\Response;
use App\Mail\Order\AdminOrderMail;
use App\Mail\Order\AchieveYourOrder;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Deliveries\DeliveryserviceContract;
use App\Http\Resources\Deliveries\DeliveriesResource;
use App\Http\Resources\Deliveries\DeliveriesCollection;
use App\Models\OrderItem;

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
        $delivery = Delivery::create($data);
        $order = Order::find($delivery->order_id);
        $orderItem = OrderItem::where('order_id',$delivery->order_id)->get();
        Mail::to($delivery->email)->send(new AchieveYourOrder($order,$orderItem,$delivery));
        Mail::to(env('MAIL_ADMIN_EMAIL'))->send(new AdminOrderMail($order,$orderItem,$delivery));
        return new DeliveriesResource($delivery);
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
