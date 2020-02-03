<?php

namespace App\Http\Resources\Api\teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiTeacherTeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'default_teacher_id' => $this->default_teacher_id,
        ];
    }
}
