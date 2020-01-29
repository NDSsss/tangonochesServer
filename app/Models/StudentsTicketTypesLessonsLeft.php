<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentsTicketTypesLessonsLeft extends Model
{
    protected $fillable = [
        'student_id',
        'ticket_event_type_id',
        'ticket_id',
        'lessons_left',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function ticketEventType()
    {
        return $this->belongsTo(TicketEventType::class);
    }
}
