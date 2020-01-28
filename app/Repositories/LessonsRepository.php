<?php


namespace App\Repositories;


use App\Models\Lesson;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

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

    function storeItem($data): Model
    {
        if (!array_key_exists('present_teachers', $data)) {
            $data['present_teachers'] = [];
        }
        if (!array_key_exists('present_students', $data)) {
            $data['present_students'] = [];
        }
        $presentTeachers = $data['present_teachers'];
        $presentStudents = $data['present_students'];
        \DB::beginTransaction();
        $lesson = $this->startConditions()::create($data);
        $teachersResult = $lesson->teachers()->sync($presentTeachers);
        $studentsResult = $lesson->students()->sync($presentStudents);
        if($lesson && $studentsResult && $teachersResult){
            \DB::commit();
            return $lesson;
        } else {
            \DB::rollBack();
            return $lesson;
        }
    }


    public function updateLesson($id,$data){

        if (!array_key_exists('present_teachers', $data)) {
            $data['present_teachers'] = [];
        }
        if (!array_key_exists('present_students', $data)) {
            $data['present_students'] = [];
        }
        $presentTeachers = $data['present_teachers'];
        $presentStudents = $data['present_students'];
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

    function destroyItem($id)
    {
        \DB::beginTransaction();
        $deleteStudentsResult = \DB::table('lessons_students')->where('lesson_id','=',$id)->delete();
        $deleteTeachersResult = \DB::table('lessons_teachers')->where('lesson_id','=',$id)->delete();
        $deleteLesson = Lesson::destroy($id);
        $result = $deleteStudentsResult && $deleteTeachersResult && $deleteLesson;
        if($result){
            \DB::commit();
        } else {
            \DB::rollBack();
        }
        return $result;
    }


}
