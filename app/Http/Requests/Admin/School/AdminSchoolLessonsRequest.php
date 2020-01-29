<?php

namespace App\Http\Requests\Admin\School;

use Illuminate\Foundation\Http\FormRequest;

class AdminSchoolLessonsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function prepareForValidation()
    {
        if($this->exists('present_teachers')){
            $presentTeachers = $this['present_teachers'];
        } else{
            $presentTeachers = [];
        }
        if($this->exists('present_students')){
            $presentStudents = $this['present_students'];
        } else{
            $presentStudents = [];
        }
        $this->merge(
            [
                'group_id'=>(int)$this['group_id'],
                'present_teachers'=>$presentTeachers,
                'present_students'=>$presentStudents,
            ]
        );

        $all = $this->request->all();
        $log = json_encode($all);
        \Log::debug("AdminSchoolLessonsRequest prepareForValidation all $log");
    }


}
