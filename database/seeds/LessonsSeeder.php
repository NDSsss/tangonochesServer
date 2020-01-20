<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = DB::table('groups')->get(['id','name']);

        $lessons = [];

        foreach ($groups as $group){
            for ($i = 1; $i<11; $i++){
                $lessons[] = [
                    'name' => $group->name . " {$i}",
                    'group_id' => $group->id
                ];
            }
        }



        DB::table('lessons')->insert($lessons);
    }
}
