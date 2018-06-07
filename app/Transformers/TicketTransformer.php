<?php

namespace App\Transformers;

use App\Models\Ticket;

class TicketTransformer extends Transformer
{
    public function transform(Ticket $ticket)
    {
        return [
            'id' => $ticket->public_token,
            'title' => $ticket->title,
            'status' => $ticket->status,
            'priority' => $ticket->priority,
            'body' => $ticket->body,
            'requester' => [
                'name' => $ticket->requester->name,
                'email' => $ticket->requester->email,
            ],
        ];
    }

}
