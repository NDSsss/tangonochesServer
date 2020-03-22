<?php

namespace App\Http\Requests\Api\Teacher;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class GetTokenRequest extends BaseApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|exists:teachers,email',
            'password'=>'required'
        ];
    }


}
