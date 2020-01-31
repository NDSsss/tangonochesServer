<?php

namespace App\Http\Requests\Admin\School;

use Illuminate\Foundation\Http\FormRequest;

class AdminSchoolEventAnnounceRequest extends FormRequest
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
            'is_active' => $this['is_active'] != null,
        ]);
    }
}
