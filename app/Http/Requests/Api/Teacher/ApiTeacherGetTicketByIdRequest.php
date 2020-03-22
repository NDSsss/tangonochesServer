<?php

namespace App\Http\Requests\Api\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class ApiTeacherGetTicketByIdRequest extends BaseApiTeacherRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $parentRules = parent::rules();
        $requiredRules = [
            'id' => 'required|integer|exists:tickets,id'
        ];
        $resultRules = array_merge($parentRules, $requiredRules);
        return $resultRules;
    }
}
