<?php

namespace App\Http\Requests\Api\Teacher;

use App\Http\Requests\Api\BaseApiRequest;
use App\Models\Teacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BaseApiTeacherRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $teachers = Teacher::query()->where('api_token', $this->header('Authorization'))->get();
        $count = count($teachers);
        if ($count > 0) {
            \Auth::setUser($teachers->first());
        }
        return $count > 0;
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
}
