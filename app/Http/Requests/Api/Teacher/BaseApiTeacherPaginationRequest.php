<?php

namespace App\Http\Requests\Api\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class BaseApiTeacherPaginationRequest extends BaseApiTeacherRequest
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
            'page'=>'required|integer',
            'count_on_page'=>'required|integer',
        ];
        $resultRules = array_merge($parentRules,$requiredRules);
//        dd($parentRules, $requiredRules, $resultRules);
        return $resultRules;
    }
}
