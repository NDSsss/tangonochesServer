<?php

namespace App\Http\Requests\Api\Teacher;

use App\Http\Requests\Api\BaseApiRequest;

class TeacherRegisterLessonRequest extends BaseApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'group_id' => 'required|exists:groups,id',
            'present_teachers' => 'present',
            'present_students' => 'present',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'group_id' => (int)$this['group_id']
            ]
        );

        $all = $this->request->all();
        $log = json_encode($all);
        \Log::debug("TeacherRegisterLessonRequest prepareForValidation all $log");
    }


}
