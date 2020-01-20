<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $values = [];
//        $lessonsSet = [];
//        $groupsCount = DB::table('groups')->count();
//        for ($groupIterator = 1; $groupIterator < $groupsCount + 1; $groupIterator++) {
//            $lessonsSet[] = DB::table('lessons')->get(['id', 'group_id'])->where('group_id', '=', $groupIterator);
//        }
//        $students = DB::table('students')->get(['id']);
//        $studentsInGroup = count($students) / $groupsCount;
//
//        foreach ($lessonsSet as $lessonsKey => $lessons) {
//            foreach ($lessons as $lessonKey => $lesson) {
//                $studentsAtLesson = $lessonKey % $studentsInGroup;
//                for ($studentsAtLessonIterator = -1; $studentsAtLessonIterator < $studentsAtLesson - 1; $studentsAtLessonIterator++) {
//                    $studentId = $students[($lessonsKey * $studentsInGroup) + $studentsAtLessonIterator+1]->id;
//                    $values[] = [
//                        'lesson_id' => $lesson->id,
//                        'student_id' => $studentId,
//                    ];
//                }
//            }
//        }

        $values = [];
        $students = DB::table('students')->get(['id']);
        $lessons = DB::table('lessons')->get(['id','group_id']);
        foreach ($lessons as $lesson) {
            switch ($lesson->group_id){
                case 1:
                case 5:
                    for($i = 0; $i< 10; $i++){
                        $values[] = [
                            'lesson_id'=>$lesson->id,
                            'student_id'=>$students[$i]->id
                        ];
                    }
                    break;
                case 2:
                    for($i = 10; $i< 20; $i++){
                        $values[] = [
                            'lesson_id'=>$lesson->id,
                            'student_id'=>$students[$i]->id
                        ];
                    }
                    break;
                case 3:
                    for($i = 20; $i< 30; $i++){
                        $values[] = [
                            'lesson_id'=>$lesson->id,
                            'student_id'=>$students[$i]->id
                        ];
                    }
                    break;
                case 4:
                    for($i = 30; $i< 38; $i++){
                        $values[] = [
                            'lesson_id'=>$lesson->id,
                            'student_id'=>$students[$i]->id
                        ];
                    }
                    break;
            }
        }

        DB::table('lessons_students')->insert($values);
    }
}
