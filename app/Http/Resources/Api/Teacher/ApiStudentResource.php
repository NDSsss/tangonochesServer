<?php

namespace App\Http\Resources\Api\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiStudentResource extends JsonResource
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
            'phone'=>$this->phone,
            'barcode_id'=>$this->barcode_id,
        ];
    }
}
