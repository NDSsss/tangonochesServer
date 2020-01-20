<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventAnnounceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [];

        $values[] = $this->getPracticeTemplate('Практика','01-10',true, false);
        $values[] = $this->getPracticeTemplate('Практика','01-17',true, false);
        $values[] = $this->getPracticeTemplate('Практика','01-25',true, true);
        $values[] = $this->getPracticeTemplate('Практика','01-31',true, true);

        $values[] = $this->getPracticeTemplate('Милонга Sentimental','01-18',false, false);
        $values[] = $this->getPracticeTemplate('Милонга Sentimental','02-01',false, true);

        DB::table('event_announces')->insert($values);
    }

    function getPracticeTemplate($name, $date,$isNecrasova, $isActive){
        return [
            'name'=>$name,
            'start_date'=>"2020-{$date} 19:00:00",
            'end_date'=>"2020-{$date} 22:00:00",
            'address' => $isNecrasova?'ул. Некрасова 18/1':'пр. Кирова 32',
            'is_active'=>$isActive,
        ];
    }

}
