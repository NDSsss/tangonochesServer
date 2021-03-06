<?php

namespace App\Http\Requests\Api\Teacher;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateLessonRequest extends BaseApiTeacherRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $updateFields = [
            'id'=>'required|exists:lessons,id'
        ];
        $registerRequest = new TeacherRegisterLessonRequest();
        $registerFields = $registerRequest->rules();
        $resultFields = array_merge($updateFields,$registerFields);
        return $resultFields;
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'group_id' => (int)$this['group_id'],
                'id' => (int)$this['id']
            ]
        );

        $all = $this->request->all();
        $log = json_encode($all);
        \Log::debug("TeacherUpdateLessonRequest prepareForValidation all $log");
    }


}
