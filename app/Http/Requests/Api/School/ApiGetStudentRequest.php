<?php

namespace App\Http\Requests\Api\School;

class ApiGetStudentRequest extends BaseApiRequestRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'barcode_id' => 'exists:students,barcode_id'
        ];
    }
}
