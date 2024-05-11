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
     * @param Notification $Notification
     */
    public function show(Notification $Notification);


    public function index();

    /**
     * @param Notification $Notification
     * @param array $data
     */
    public function update(Notification $Notification, array $data);


    /**
     * @param Notification $Notification
     */
    public function delete(Notification $Notification);
}
