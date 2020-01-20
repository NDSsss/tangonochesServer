<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsSeeder extends Seeder
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
                    $values[] = $this->getTemplateTicket(1,1,1,$students[0]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(2,1,1,$students[0]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(3,1,1,$students[0]->student_id,2, false);

                    $values[] = $this->getTemplateTicket(1,2,1,$students[1]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(2,2,1,$students[1]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(3,2,1,$students[1]->student_id,2, false);

                    $values[] = $this->getTemplateTicket(1,3,1,$students[2]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(2,3,1,$students[2]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(3,3,1,$students[2]->student_id,2, false);

                    $values[] = $this->getTemplateTicket(1,3,1,$students[3]->student_id,2, true);
                    $values[] = $this->getTemplateTicket(2,3,1,$students[3]->student_id,2, true);
                    $values[] = $this->getTemplateTicket(3,3,1,$students[3]->student_id,2, true);

                    $values[] = $this->getTemplateTicket(1,3,1,$students[4]->student_id,2, true);
                    $values[] = $this->getTemplateTicket(2,3,1,$students[4]->student_id,2, true);
                    $values[] = $this->getTemplateTicket(3,3,1,$students[4]->student_id,2, true);

                    $values[] = $this->getTemplateTicket(1,4,1,$students[5]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(2,4,1,$students[5]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(3,4,1,$students[5]->student_id,2, false);
                    break;
                case 2:
                    //Nastya -tango
                    $values[] = $this->getTemplateTicket(1,1,1,$students[0]->student_id,5, false);
                    $values[] = $this->getTemplateTicket(2,1,1,$students[0]->student_id,5, false);
                    $values[] = $this->getTemplateTicket(3,1,1,$students[0]->student_id,5, false);

                    $values[] = $this->getTemplateTicket(1,2,1,$students[1]->student_id,5, false);
                    $values[] = $this->getTemplateTicket(2,2,1,$students[1]->student_id,5, false);
                    $values[] = $this->getTemplateTicket(3,2,1,$students[1]->student_id,5, false);

                    $values[] = $this->getTemplateTicket(1,3,1,$students[2]->student_id,5, false);
                    $values[] = $this->getTemplateTicket(2,3,1,$students[2]->student_id,5, false);
                    $values[] = $this->getTemplateTicket(3,3,1,$students[2]->student_id,5, false);

                    $values[] = $this->getTemplateTicket(1,3,1,$students[3]->student_id,5, true);
                    $values[] = $this->getTemplateTicket(2,3,1,$students[3]->student_id,5, true);
                    $values[] = $this->getTemplateTicket(3,3,1,$students[3]->student_id,5, true);

                    $values[] = $this->getTemplateTicket(1,3,1,$students[4]->student_id,5, true);
                    $values[] = $this->getTemplateTicket(2,3,1,$students[4]->student_id,5, true);
                    $values[] = $this->getTemplateTicket(3,3,1,$students[4]->student_id,5, true);

                    $values[] = $this->getTemplateTicket(1,4,1,$students[5]->student_id,5, false);
                    $values[] = $this->getTemplateTicket(2,4,1,$students[5]->student_id,5, false);
                    $values[] = $this->getTemplateTicket(3,4,1,$students[5]->student_id,5, false);
                    break;
                case 5:
                    //Anton - folk
                    $values[] = $this->getTemplateTicket(1,1,2,$students[0]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(2,1,2,$students[0]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(3,1,2,$students[0]->student_id,2, false);

                    $values[] = $this->getTemplateTicket(1,2,2,$students[1]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(2,2,2,$students[1]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(3,2,2,$students[1]->student_id,2, false);

                    $values[] = $this->getTemplateTicket(1,3,2,$students[2]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(2,3,2,$students[2]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(3,3,2,$students[2]->student_id,2, false);

                    $values[] = $this->getTemplateTicket(1,3,2,$students[3]->student_id,2, true);
                    $values[] = $this->getTemplateTicket(2,3,2,$students[3]->student_id,2, true);
                    $values[] = $this->getTemplateTicket(3,3,2,$students[3]->student_id,2, true);

                    $values[] = $this->getTemplateTicket(1,3,2,$students[4]->student_id,2, true);
                    $values[] = $this->getTemplateTicket(2,3,2,$students[4]->student_id,2, true);
                    $values[] = $this->getTemplateTicket(3,3,2,$students[4]->student_id,2, true);

                    $values[] = $this->getTemplateTicket(1,4,2,$students[5]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(2,4,2,$students[5]->student_id,2, false);
                    $values[] = $this->getTemplateTicket(3,4,2,$students[5]->student_id,2, false);
                    break;
            }
        }

        DB::table('tickets')->insert($values);
    }

    function getTemplateTicket($dateNumber, $ticket_count_type_id, $ticket_event_type_id, $student_id, $teacher_id, $is_in_pair = false){
        switch ($dateNumber){
            case 1:
                return [
                    'ticket_start_date'=>'2019-11-06 19:45:00',
                    'ticket_end_date'=>'2019-12-06 19:45:00',
                    'ticket_count_type_id'=>$ticket_count_type_id,
                    'ticket_event_type_id'=>$ticket_event_type_id,
                    'student_id'=>$student_id,
                    'teacher_id'=>$teacher_id,
                    'is_in_pair'=>$is_in_pair,
                ];
                break;
            case 2:
                return [
                    'ticket_start_date'=>'2019-12-07 19:45:00',
                    'ticket_end_date'=>'2020-01-07 19:45:00',
                    'ticket_count_type_id'=>$ticket_count_type_id,
                    'ticket_event_type_id'=>$ticket_event_type_id,
                    'student_id'=>$student_id,
                    'teacher_id'=>$teacher_id,
                    'is_in_pair'=>$is_in_pair,
                ];
                break;
            case 3:
                return [
                    'ticket_start_date'=>'2020-01-08 19:45:00',
                    'ticket_end_date'=>'2020-02-08 19:45:00',
                    'ticket_count_type_id'=>$ticket_count_type_id,
                    'ticket_event_type_id'=>$ticket_event_type_id,
                    'student_id'=>$student_id,
                    'teacher_id'=>$teacher_id,
                    'is_in_pair'=>$is_in_pair,
                ];
                break;
        }
    }
}
