<?php

namespace App\Models;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use Notifiable;

    public static $currDate = '2019-11-06';

    /** @var DateTime $currDate */
    protected $attributes = [
        'is_in_pair' => false,
        'is_nullify' => true,
        'extra_lessons' => 0,
    ];

    protected $fillable = [
        'ticket_count_type_id',
        'ticket_event_type_id',
        'ticket_end_date',
        'ticket_start_date',
        'ticket_bought_date',
        'student_id',
        'teacher_id',
        'is_in_pair',
        'is_nullify',
        'extra_lessons',
    ];

    protected $casts = [
        'ticket_count_type_id' => "integer",
        'ticket_event_type_id' => "integer",
        'ticket_end_date' => "date:Y.m.d",
        'ticket_start_date' => "date:Y.m.d",
        'ticket_bought_date' => "date:Y.m.d",
        'student_id' => "integer",
        'teacher_id' => "integer",
        'is_in_pair' => "boolean",
        'is_nullify' => "boolean",
        'extra_lessons' => "integer",
    ];

    public function __construct(array $attributes = [])
    {
        $date = new DateTime('now', new DateTimeZone('Europe/Moscow'));
        $currDate = $date->format('Y-m-d H:m:s');
        $ticketStartDate = $date->format('Y-m-d');
        $date->modify('+1 month');
        $ticketEndDate = $date->format('Y-m-d');
        $this->attributes['ticket_bought_date'] = $currDate;
        $this->attributes['ticket_start_date'] = $ticketStartDate;
        $this->attributes['ticket_end_date'] = $ticketEndDate;
        parent::__construct($attributes);
    }

    public function studentsTicketTypesLessonsLeft(){
        return $this->hasOne(StudentsTicketTypesLessonsLeft::class,'ticket_id', 'id');
    }


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function ticketCountType()
    {
        return $this->belongsTo(TicketCountType::class);
    }

    public function ticketEventType()
    {
        return $this->belongsTo(TicketEventType::class);
    }
}
