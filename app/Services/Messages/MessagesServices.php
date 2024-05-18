<?php

namespace App\Services\Messages;

use App\Models\Message;
use Illuminate\Http\Response;
use App\Contracts\Messages\MessageServiceContract;
use App\Http\Resources\Messages\MessagesResource;
use App\Http\Resources\Messages\MessagesCollection;
use App\Mail\UserContactDeballage;
use Illuminate\Support\Facades\Mail;

class MessagesServices implements MessageServiceContract
{

    /**
     * create a Message
     * 
     * @param array $data.
     * @return MessagesResource.
     */
    public function create($data): MessagesResource
    {   
        Mail::send(new UserContactDeballage($data));
        return new MessagesResource(Message::create($data));
    }

    /**
     * update a Message
     * 
     * @param Message $message.
     * @return MessagesResource.
     */
    public function update(Message $message, array $data): MessagesResource
    {
        $message->update($data);
        return new MessagesResource($message);
    }


    /**
     * get all Messages
     * 
     * @return array.
     */

    public function index(): MessagesCollection
    {

        return new MessagesCollection(Message::all());
    }


    /**
     * get a Message
     * @param Message mMessage
     * @return MessagesResource.
     */

    public function show(Message $message): MessagesResource
    {
        return new MessagesResource($message);
    }



    /**
     * delete a Message
     * 
     * @param Message $message.
     * @return Illuminate\Http\Response.
     */

    public function delete(Message $message): Response
    {
        $message->delete();

        return response()->noContent();
    }
}
