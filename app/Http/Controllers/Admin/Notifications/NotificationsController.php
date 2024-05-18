<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Contracts\Notifications\NotificationServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\NotificationsStoreRequest;
use App\Http\Requests\Notifications\NotificationsUpdateRequest;
use App\Models\Notification;

class NotificationsController extends Controller
{
    private $notificationsService;

    public function __construct(NotificationServiceContract $notificationsService)
    {
        $this->notificationsService = $notificationsService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->notificationsService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationsStoreRequest $request)
    {
        return  $this->notificationsService->create($request->validated());
    }

    /**
     * Display the specified notification.
     * 
     */
    public function show(Notification $notification)
    {
        return $this->notificationsService->show($notification);
    }

    /**
     * Update the specified notification in storage.
     */
    public function update(NotificationsUpdateRequest $request, Notification $notification)
    {
        return $this->notificationsService->update($notification, $request->validated());
    }

    /**
     * Remove the specified notification from storage.
     */
    public function destroy(Notification $notification)
    {
        return $this->notificationsService->delete($notification);
    }
}
