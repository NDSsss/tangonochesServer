<?php

namespace App\Repositories;


use App\Models\Notification;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class NotificationRepo extends BaseRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass()
    {
        return Notification::class;
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'title', 'text', 'prev_text', 'date', 'platform'];
    }

    public function update($id, $data)
    {
        $notification = Notification::find($id);
        $notification->update($data);
        $notification->students()->sync($data['present_students']);
        return true;
    }

    function storeItem($data): Model
    {
        $notification = $this->model->fill($data);
        \DB::beginTransaction();
        $newNotification = $notification->save();
        $notification->students()->attach($data['present_students']);

        if ($newNotification) {
            \DB::commit();
            $refreshedLesson = $notification->refresh();
            return $refreshedLesson;
        } else {
            \DB::rollBack();
            return null;
        }

    }

    public function getAllStudentsOfNotification($id)
    {
        $notification = Notification::find($id);
        $students = $notification->students;
        $allStudents = Student::query()->select(['id', 'name'])->get();
        foreach ($allStudents as $student) {
            if ($students->contains('id', $student->id)) {
                $student->selected = true;
            } else {
                $student->selected = false;
            }
        }
        return $allStudents;
    }
}