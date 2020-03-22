<?php

namespace App\Http\Requests\Api\Teacher;

class TeacherRegisterStudentRequest extends BaseApiTeacherRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'phone' => 'nullable|unique:students,phone',
            'vk_profile_link' => 'nullable|unique:students,vk_profile_link',
            'vk_profile_id' => 'nullable|unique:students,vk_profile_id',
            'facebook_profile_link' => 'nullable|unique:students,facebook_profile_link',
            'facebook_profile_id' => 'nullable|unique:students,facebook_profile_id',
            'instagram_profile_link' => 'nullable|unique:students,instagram_profile_link',
            'instagram_profile_id' => 'nullable|unique:students,instagram_profile_id',
            'photo_link' => 'nullable',
            'extra_info' => 'nullable',
            'push_token' => 'nullable|unique:students,push_token',
            'barcode_id' => 'nullable|unique:students,barcode_id',
        ];
    }
}
