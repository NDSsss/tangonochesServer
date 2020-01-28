<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_start_date',
        'ticket_end_date',
        'ticket_bought_date',
        'ticket_count_type_id',
        'ticket_event_type_id',
        'student_id',
        'teacher_id',
        'is_in_pair'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function ticketCountType(){
        return $this->belongsTo(TicketCountType::class);
    }

    public function ticketEventType(){
        return $this->belongsTo(TicketEventType::class);
    }
}
