<?php

namespace App\Http\Requests\Api\Teacher;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherRegisterTicketRequest extends BaseApiTeacherRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ticket_count_type_id'=>'required|exists:ticket_count_types,id',
            'ticket_event_type_id'=>'required|exists:ticket_event_types,id',
            'ticket_start_date'=>'required',
            'ticket_end_date'=>'required',
            'student_id'=>'required|exists:students,id',
            'teacher_id'=>'required|exists:teachers,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'ticket_count_type_id' => (int)$this['ticket_count_type_id'],
            'ticket_event_type_id' => (int)$this['ticket_event_type_id'],
            'student_id' => (int)$this['student_id'],
            'teacher_id' => (int)$this['teacher_id'],
            'extra_lessons' => (int)$this['extra_lessons'],
            'is_in_pair' => $this['is_in_pair'] != null,
            'is_nullify' => $this['is_nullify'] != null,
        ]);
    }
}
