<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getStudentsUrl = 'https://script.google.com/macros/s/AKfycbwwgtPVBck0oKJ3FU435xcbhVHbz0AXh09UvsHwe1AmRwsWfsuF/exec?action=getStudents';
        $jsonAnswer = json_decode(file_get_contents($getStudentsUrl), true);
        $usersToInsert = [];
        if ($jsonAnswer['result'] == 0) {
            $usersRaw = $jsonAnswer['students'];
            foreach ($usersRaw as $keyy=>$ur) {
                $studSql = [
                    'name' => $ur['name'],
                    'phone' => "{$keyy}",
                    'vk_profile_link' => $ur['vk_link'],
                    'vk_profile_id' => $keyy,
                    'facebook_profile_link' => 'facebook_profile_link def',
                    'facebook_profile_id' => $keyy,
                    'instagram_profile_link' => 'instagram_profile_link def',
                    'instagram_profile_id' => $keyy,
                    'photo_link' => 'photo_link def',
                    'extra_info'  => $ur['extra_inf'],
                    'push_token' => 'push_token def',
                    'barcode_id' => $keyy,
                ];
                $usersToInsert[] = $studSql;
                /*
                $stud = new \App\Models\Student();
                $stud->fill([
                    'name'=>$ur->name,
                    'phone'=>$ur->phone,
                    'vk_profile_link'=>$ur->vk_link,
                    'extra_info'=>"$ur->extra_inf"
                ]);
                $usersToInsert[] = $stud;
                */
            }
        } else {
            for ($i = 0; $i < 30; $i++) {
                $stud = new \App\Models\Student();
                $stud->fill([
                    'name' => "{$i}",
                    'phone' => "{$i}",
                    'vk_profile_link' => "{$i}",
                    'vk_profile_id' => $i,
                    'extra_info' => "{$i}"
                ]);
                $usersToInsert[] = $stud;
            }
        }

        /*
        $usersToInsert = [];

        for($i = 0; $i<=10; $i++){
            $usersToInsert[]=[
                'name' => 'name'.$i,
                'phone' => 'phone'.$i,
                'vk_profile_link' => 'vk_profile_link'.$i,
                'vk_profile_id' => $i,
                'facebook_profile_link' => 'facebook_profile_link'.$i,
                'facebook_profile_id' => $i,
                'instagram_profile_link' => 'instagram_profile_link'.$i,
                'instagram_profile_id' => $i,
                'photo_link' => 'photo_link'.$i,
                'extra_info' => 'extra_info'.$i,
                'push_token' => 'push_token'.$i,
                'barcode_id' => $i,

            ];
        }
        */

        DB::table('students')->insert($usersToInsert);
    }
}
