<?php

namespace App\Http\Resources\Api\teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiTeacherGroupResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'first_lesson_time'=>$this->first_lesson_time,
            'second_lesson_time'=>$this->second_lesson_time,
            'ticket_event_type_id'=>$this->ticket_event_type_id,
            'address'=>$this->address,
        ];
    }
}
