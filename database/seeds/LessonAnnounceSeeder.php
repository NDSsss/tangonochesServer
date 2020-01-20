<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonAnnounceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [];

        $values[] = $this->getTemplate(1,'01-06 19:00:00', true, false);
        $values[] = $this->getTemplate(4,'01-06 20:00:00', true, false);
        $values[] = $this->getTemplate(3,'01-07 20:00:00', true, false);
        $values[] = $this->getTemplate(2,'01-07 19:45:00', false, false);
        $values[] = $this->getTemplate(1,'01-08 19:00:00', true, false);
        $values[] = $this->getTemplate(4,'01-08 20:00:00', true, false);
        $values[] = $this->getTemplate(3,'01-09 20:00:00', true, false);
        $values[] = $this->getTemplate(2,'01-09 19:45:00', false, false);

        $values[] = $this->getTemplate(1,'01-13 19:00:00', true, false);
        $values[] = $this->getTemplate(4,'01-13 20:00:00', true, false);
        $values[] = $this->getTemplate(3,'01-14 20:00:00', true, false);
        $values[] = $this->getTemplate(2,'01-14 19:45:00', false, false);
        $values[] = $this->getTemplate(1,'01-15 19:00:00', true, false);
        $values[] = $this->getTemplate(4,'01-15 20:00:00', true, false);
        $values[] = $this->getTemplate(3,'01-16 20:00:00', true, false);
        $values[] = $this->getTemplate(2,'01-16 19:45:00', false, false);

        $values[] = $this->getTemplate(1,'01-20 19:00:00', true, false);
        $values[] = $this->getTemplate(4,'01-20 20:00:00', true, false);
        $values[] = $this->getTemplate(3,'01-21 20:00:00', true, false);
        $values[] = $this->getTemplate(2,'01-21 19:45:00', false, false);
        $values[] = $this->getTemplate(1,'01-22 19:00:00', true, false);
        $values[] = $this->getTemplate(4,'01-22 20:00:00', true, false);
        $values[] = $this->getTemplate(3,'01-23 20:00:00', true, false);
        $values[] = $this->getTemplate(2,'01-23 19:45:00', false, false);

        $values[] = $this->getTemplate(1,'01-27 19:00:00', true, true);
        $values[] = $this->getTemplate(4,'01-27 20:00:00', true, true);
        $values[] = $this->getTemplate(3,'01-28 20:00:00', true, true);
        $values[] = $this->getTemplate(2,'01-28 19:45:00', false, true);
        $values[] = $this->getTemplate(1,'01-29 19:00:00', true, true);
        $values[] = $this->getTemplate(4,'01-29 20:00:00', true, true);
        $values[] = $this->getTemplate(3,'01-30 20:00:00', true, true);
        $values[] = $this->getTemplate(2,'01-30 19:45:00', false, true);

        $values[] = $this->getTemplate(1,'02-03 19:00:00', true, true);
        $values[] = $this->getTemplate(4,'02-03 20:00:00', true, true);
        $values[] = $this->getTemplate(3,'02-04 20:00:00', true, true);
        $values[] = $this->getTemplate(2,'02-04 19:45:00', false, true);
        $values[] = $this->getTemplate(1,'02-05 19:00:00', true, true);
        $values[] = $this->getTemplate(4,'02-05 20:00:00', true, true);
        $values[] = $this->getTemplate(3,'02-06 20:00:00', true, true);
        $values[] = $this->getTemplate(2,'02-06 19:45:00', false, true);

        DB::table('lesson_announces')->insert($values);
    }

    function getTemplate($groupId, $date, $isNecrasova,$isActive){
        return [
            'name'=>"Урок {$groupId}",
            'group_id'=>$groupId,
            'start_date'=>"2020-{$date}",
            'end_date'=>"2020-{$date}",
            'address' => $isNecrasova?'ул. Некрасова 18/1':'пр. Кирова 32',
            'is_active'=>$isActive,
        ];
    }
}
