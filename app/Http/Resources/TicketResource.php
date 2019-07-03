<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->public_token,
            'title' => $this->title,
            'status' => $this->status,
            'priority' => $this->priority,
            'body' => $this->body,
            'requester' => [
                'name' => $this->requester->name,
                'email' => $this->requester->email,
                'external_id' => $this->requester->external_id,
            ],
        ];

        return parent::toArray($request);
    }
}
