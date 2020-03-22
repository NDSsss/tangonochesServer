<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lesson extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'group_id',
    ];

    //

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'lessons_students', 'lesson_id', 'student_id')->select(['id', 'name']);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'lessons_teachers', 'lesson_id', 'teacher_id')->select(['id', 'name']);
    }


}
