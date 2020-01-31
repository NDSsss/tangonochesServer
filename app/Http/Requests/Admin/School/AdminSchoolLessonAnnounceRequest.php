<?php

namespace App\Http\Requests\Admin\School;

use Illuminate\Foundation\Http\FormRequest;

class AdminSchoolLessonAnnounceRequest extends FormRequest
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
        $this->merge([
            'group_id' => (int)$this['group_id'],
            'is_active' => $this['is_active'] != null,
        ]);
    }
}
