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
        $getStudentsUrl = env('VOLOCHKOV_SHEETS_URL');
        $jsonAnswer = json_decode(file_get_contents($getStudentsUrl), true);
        $usersToInsert = [];
//        $usersToInsert[] = [
//            'name' => 'No Name',
//            'phone' => "No Phone",
//            'vk_profile_link' => 'No Value',
//            'vk_profile_id' => -1,
//            'facebook_profile_link' => 'No Value def',
//            'facebook_profile_id' => -1,
//            'instagram_profile_link' => 'No Value',
//            'instagram_profile_id' => -1,
//            'photo_link' => 'No Value',
//            'extra_info' => 'No Value',
//            'push_token' => 'No Value',
//            'barcode_id' => -1,
//        ];
        if ($jsonAnswer['result'] == 0) {
            $usersRaw = $jsonAnswer['students'];
            foreach ($usersRaw as $keyy => $ur) {
                $studSql = [
                    'name' => $ur['name'],
                    'phone' => "{$keyy}",
                    'vk_profile_link' => null,
                    'vk_profile_id' => null,
                    'facebook_profile_link' => null,
                    'facebook_profile_id' => null,
                    'instagram_profile_link' => null,
                    'instagram_profile_id' => null,
                    'photo_link' => null,
                    'extra_info' => null,
                    'push_token' => null,
                    'barcode_id' => null,
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
