<?php

namespace App\Http\Controllers\Admin\Messages;

use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Contracts\Messages\MessageServiceContract;
use App\Http\Requests\Messages\MessagesStoreRequest;
use App\Http\Requests\Messages\MessagesUpdateRequest;

class MessagesController extends Controller
{
    private $messagesService;

    public function __construct(MessageServiceContract $messagesService)
    {
        $this->messagesService = $messagesService;
    }

    /**
     * Display a listing of the categorys.
     * 
     */
    public function index()
    {
        return $this->messagesService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessagesStoreRequest $request)
    {
        return  $this->messagesService->create($request->validated());
    }

    /**
     * Display the specified message.
     * 
     */
    public function show(Message $message)
    {
        return $this->messagesService->show($message);
    }

    /**
     * Update the specified message in storage.
     */
    public function update(MessagesUpdateRequest $request, Message $message)
    {
        return $this->messagesService->update($message, $request->validated());
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message)
    {
        return $this->messagesService->delete($message);
    }
}
