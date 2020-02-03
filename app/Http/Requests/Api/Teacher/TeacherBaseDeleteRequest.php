<?php

namespace App\Http\Requests\Api\Teacher;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherBaseDeleteRequest extends BaseApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'id' => (int)$this['id']
            ]
        );

        $all = $this->request->all();
        $log = json_encode($all);
        \Log::debug("TeacherBaseDeleteRequest prepareForValidation all $log");
    }


}
