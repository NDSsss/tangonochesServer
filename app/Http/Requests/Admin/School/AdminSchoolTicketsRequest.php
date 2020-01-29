<?php

namespace App\Http\Requests\Admin\School;

use Illuminate\Foundation\Http\FormRequest;

class AdminSchoolTicketsRequest extends FormRequest
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
            'ticket_count_type_id' => (int)$this['ticket_count_type_id'],
            'ticket_event_type_id' => (int)$this['ticket_event_type_id'],
            'ticket_bought_date' => str_replace('T', ' ', $this['ticket_bought_date']),
            'student_id' => (int)$this['student_id'],
            'teacher_id' => (int)$this['teacher_id'],
            'extra_lessons' => (int)$this['extra_lessons'],
            'is_in_pair' => $this['is_in_pair'] != null,
            'is_nullify' => $this['is_nullify'] != null,
        ]);
    }


}
