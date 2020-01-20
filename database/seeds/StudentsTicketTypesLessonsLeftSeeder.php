<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTicketTypesLessonsLeftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [];
        $groups = DB::table('groups')->get(['id']);
        foreach ($groups as $group) {
            $students = DB::select("SELECT distinct student_id FROM lessons_students where lesson_id in (select id from lessons where group_id = {$group->id})");
            switch ($group->id){
                case 1:
                case 3:
                case 4:
                    //Anton - tango
                    $values[] = $this->getTemplate($students[0]->student_id,1, 4);
                    $values[] = $this->getTemplate($students[1]->student_id,1, 8);
                    $values[] = $this->getTemplate($students[2]->student_id,1, 12);
                    $values[] = $this->getTemplate($students[3]->student_id,1, 12);
                    $values[] = $this->getTemplate($students[4]->student_id,1, 12);
                    $values[] = $this->getTemplate($students[5]->student_id,1, 1);
                    break;
                case 2:
                    //Nastya -tango
                    $values[] = $this->getTemplate($students[0]->student_id,1, 4);
                    $values[] = $this->getTemplate($students[1]->student_id,1, 8);
                    $values[] = $this->getTemplate($students[2]->student_id,1, 12);
                    $values[] = $this->getTemplate($students[3]->student_id,1, 12);
                    $values[] = $this->getTemplate($students[4]->student_id,1, 12);
                    $values[] = $this->getTemplate($students[5]->student_id,1, 1);
                    break;
                case 5:
                    //Anton - folk
                    $values[] = $this->getTemplate($students[0]->student_id,2, 4);
                    $values[] = $this->getTemplate($students[1]->student_id,2, 8);
                    $values[] = $this->getTemplate($students[2]->student_id,2, 12);
                    $values[] = $this->getTemplate($students[3]->student_id,2, 12);
                    $values[] = $this->getTemplate($students[4]->student_id,2, 12);
                    $values[] = $this->getTemplate($students[5]->student_id,2, 1);

                    break;
            }
        }

        DB::table('students_ticket_types_lessons_left')->insert($values);
    }

    function getTemplate($student_id, $ticket_event_type_id, $lessons_left){
        return [
          'student_id'=>$student_id,
          'ticket_event_type_id'=>$ticket_event_type_id,
          'lessons_left'=>$lessons_left,
        ];
    }
}
