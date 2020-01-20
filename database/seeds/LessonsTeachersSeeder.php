<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsTeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [];
        $lessons = DB::table('lessons')->get(['id', 'group_id']);
        foreach ($lessons as $lesson) {
            switch ($lesson->group_id){
                case 1:
                case 3:
                case 4:
                    //Начинающие Антон и Юля
                    $values[] = [
                        'lesson_id'=>$lesson->id,
                        'teacher_id'=>2
                    ];
                    $values[] = [
                        'lesson_id'=>$lesson->id,
                        'teacher_id'=>3
                    ];
                    break;
                case 2:
                    //Начинающие Сережа и Настя
                    $values[] = [
                        'lesson_id'=>$lesson->id,
                        'teacher_id'=>4
                    ];
                    $values[] = [
                        'lesson_id'=>$lesson->id,
                        'teacher_id'=>5
                    ];
                    break;
                case 5:
                    //Фолк Антон и Настя
                    $values[] = [
                        'lesson_id'=>$lesson->id,
                        'teacher_id'=>2
                    ];
                    $values[] = [
                        'lesson_id'=>$lesson->id,
                        'teacher_id'=>5
                    ];
                    break;
            }
        }

        DB::table('lessons_teachers')->insert($values);
    }
}
