<?php

namespace App\Http\Requests\Api\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class ApiTeacherGetLessonByIdRequest extends BaseApiTeacherRequest
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
            'id' => 'required|integer|exists:lessons,id'
        ];
        $resultRules = array_merge($parentRules, $requiredRules);
//        dd($parentRules, $requiredRules, $resultRules);
        return $resultRules;
    }
}
