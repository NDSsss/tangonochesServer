<?php

namespace App\Http\Requests\Api\Teacher;

use Illuminate\Validation\Rule;

class TeacherUpdateStudentRequest extends BaseApiTeacherRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        $updateFields = [
//            'id'=>'required','exists:students,id'
//        ];
//        $registerRequest = new TeacherRegisterStudentRequest();
//        $registerFields = $registerRequest->rules();
//        $resultFields = array_merge($updateFields,$registerFields);
        return [
            'id'=>['required','exists:students,id'],
            'name'=>'required',
            'phone' => ['nullable',Rule::unique('students','phone')->ignore($this->input('id'))],
            'vk_profile_link' => ['nullable',Rule::unique('students','vk_profile_link')->ignore($this->input('id'))],
            'vk_profile_id' => ['nullable',Rule::unique('students','vk_profile_id')->ignore($this->input('id'))],
            'facebook_profile_link' => ['nullable',Rule::unique('students','facebook_profile_link')->ignore($this->input('id'))],
            'facebook_profile_id' => ['nullable',Rule::unique('students','facebook_profile_id')->ignore($this->input('id'))],
            'instagram_profile_link' => ['nullable',Rule::unique('students','instagram_profile_link')->ignore($this->input('id'))],
            'instagram_profile_id' => ['nullable',Rule::unique('students','instagram_profile_id')->ignore($this->input('id'))],
            'photo_link' => ['nullable'],
            'extra_info' => ['nullable'],
            'push_token' => ['nullable',Rule::unique('students','push_token')->ignore($this->input('id'))],
            'barcode_id' => ['nullable',Rule::unique('students','barcode_id')->ignore($this->input('id'))],
        ];
    }
}
