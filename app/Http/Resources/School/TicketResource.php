<?php

namespace App\Http\Resources\School;

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
            'ticket_start_date'=>$this->ticket_start_date,
            'ticket_end_date'=>$this->ticket_end_date,
            'ticketCount'=>$this->ticketCountType,
            'ticketType'=>$this->ticketEventType,
        ];
    }
}
