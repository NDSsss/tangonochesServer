<?php


namespace App\Repositories;


use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;

class LessonsRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Lesson::class;
    }

    protected function getColumnsForSelect(): array
    {
        return ['id', 'name', 'group_id', 'created_at', 'updated_at'];
    }

    protected function getPaginateCount(): int
    {
        return 10;
    }

    public function getAllStudentsOfLesson($id)
    {
        $lesson = Lesson::find($id);
        $studentsPresentOnLesson = $lesson->students;
        $allStudents = Student::query()->select(['id', 'name'])->get();
        foreach ($allStudents as $student) {
            if($studentsPresentOnLesson->contains('id',$student->id)){
                $student->selected = true;
            } else {
                $student->selected = false;
            }
        }
        return $allStudents;
    }

    public function getAllTeachersOfLesson($id)
    {
        $lesson = Lesson::find($id);
        $teachersPresentOnLesson = $lesson->teachers;
        $allTeachers = Teacher::all();

        foreach ($allTeachers as $teacher) {
            if($teachersPresentOnLesson->contains('id',$teacher->id)){
                $teacher['selected'] = true;
            } else {
                $teacher['selected'] = false;
            }
        }

        return $allTeachers;
    }

    public function updateLesson($id,$data, $presentTeachers, $presentStudents){
        \DB::beginTransaction();
        $lesson = Lesson::find($id);
        $lessonResult = $lesson->update($data);
        $teachersResult = $lesson->teachers()->sync($presentTeachers);
//        dd($lessonResult);
        $studentsResult = $lesson->students()->sync($presentStudents);
        if($lessonResult && $studentsResult && $teachersResult){
            \DB::commit();
            return true;
        } else {
            \DB::rollBack();
            return false;
        }
    }
}
