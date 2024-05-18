<?php

namespace App\Services\Notifications;

use App\Models\Notification;
use Illuminate\Http\Response;
use App\Contracts\Notifications\NotificationServiceContract;
use App\Http\Resources\Notifications\NotificationsResource;
use App\Http\Resources\Notifications\NotificationsCollection;

class NotificationsServices implements NotificationServiceContract
{

    /**
     * create an $notification
     * 
     * @param array $data.
     * @return NotificationsResource.
     */
    public function create($data): NotificationsResource
    {
        return new NotificationsResource(Notification::create($data));
    }

    /**
     * update an $notification
     * 
     * @param Notification $notification.
     * @return NotificationsResource.
     */
    public function update(Notification $notification, array $data): NotificationsResource
    {
        $notification->update($data);
        return new NotificationsResource($notification);
    }


    /**
     * get all $notifications
     * 
     * @return array.
     */

    public function index(): NotificationsCollection
    {

        return new NotificationsCollection(Notification::all());
    }


    /**
     * get an $notification
     * @param Notification $notification
     * @return NotificationsResource.
     */

    public function show(Notification $notification): NotificationsResource
    {
        return new NotificationsResource($notification);
    }



    /**
     * delete an $notification
     * 
     * @param Notification $notification.
     * @return Illuminate\Http\Response.
     */

    public function delete(Notification $notification): Response
    {
        $notification->delete();

        return response()->noContent();
    }
}
