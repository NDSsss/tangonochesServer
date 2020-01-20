<?php

use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('teachers')->insert([
            ['name'=>'Не известно','default_teacher_id'=>'1'],
            ['name'=>'Антон','default_teacher_id'=>'3'],
            ['name'=>'Юля','default_teacher_id'=>'2'],
            ['name'=>'Сережа','default_teacher_id'=>'5'],
            ['name'=>'Настя','default_teacher_id'=>'4'],
        ]);
    }
}
