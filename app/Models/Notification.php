<?php
/**
 * Created by PhpStorm.
 * User: Владислав
 * Date: 05.08.2020
 * Time: 22:54
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'text',
        'prev_text',
        'date',
        'platform'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'notifications_students', 'notification_id', 'student_id')->select(['id', 'name']);
    }
}