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
            ['name'=>'Не известно','default_teacher_id'=>'1','email'=>'noname@mail.ru', 'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),'api_token'=>\Illuminate\Support\Str::random(60)],
            ['name'=>'Антон','default_teacher_id'=>'3','email'=>'anton@mail.ru', 'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),'api_token'=>\Illuminate\Support\Str::random(60)],
            ['name'=>'Юля','default_teacher_id'=>'2','email'=>'yuliya@mail.ru', 'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),'api_token'=>\Illuminate\Support\Str::random(60)],
            ['name'=>'Сережа','default_teacher_id'=>'5','email'=>'serega@mail.ru', 'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),'api_token'=>\Illuminate\Support\Str::random(60)],
            ['name'=>'Настя','default_teacher_id'=>'4','email'=>'nastya@mail.ru', 'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),'api_token'=>\Illuminate\Support\Str::random(60)],
        ]);
    }
}
