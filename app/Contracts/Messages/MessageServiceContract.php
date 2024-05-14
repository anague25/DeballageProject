<?php

namespace App\Contracts\Messages;

use App\Models\Message;

interface MessageServiceContract
{

    /**
     * @param array $data
     */
    public function create(array $data);


    /**
     * @param Message $message
     */
    public function show(Message $message);


    public function index();

    /**
     * @param Message $message
     * @param array $data
     */
    public function update(Message $message, array $data);


    /**
     * @param Message $message
     */
    public function delete(Message $message);
}
