<?php

namespace App\Contracts\Notifications;

use App\Models\Notification;

interface NotificationServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Notification $notification
     */
    public function show(Notification $notification);


    public function index();

    /**
     * @param Notification $notification
     * @param array $data
     */
    public function update(Notification $notification, array $data);


    /**
     * @param Notification $notification
     */
    public function delete(Notification $notification);
}
