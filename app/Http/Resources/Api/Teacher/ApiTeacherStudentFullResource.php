<?php

namespace App\Http\Resources\Api\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiTeacherStudentFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}