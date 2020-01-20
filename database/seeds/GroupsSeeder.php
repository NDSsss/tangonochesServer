<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('groups')->insert([
            [
                'name' => 'Начинающие Антон и Юля',
                'first_lesson_time' => '2020-01-06 19:00:00',
                'second_lesson_time' => '2020-01-08 19:00:00',
                'address' => 'ул. Некрасова 18/1',
            ],
            [
                'name' => 'Начинающие Сережа и Настя',
                'first_lesson_time' => '2020-01-07 20:00:00',
                'second_lesson_time' => '2020-01-09 20:00:00',
                'address' => 'прю Кирова 32',
            ],
            [
                'name' => 'Продолжающие Антон и Юля',
                'first_lesson_time' => '2020-01-07 19:45:00',
                'second_lesson_time' => '2020-01-09 19:45:00',
                'address' => 'ул. Некрасова 18/1',
            ],
            [
                'name' => 'Продвинутые Антон и Юля',
                'first_lesson_time' => '2020-01-06 20:00:00',
                'second_lesson_time' => '2020-01-08 20:00:00',
                'address' => 'ул. Некрасова 18/1',
            ],
            [
                'name' => 'Фолк Антон и Настя',
                'first_lesson_time' => '2020-01-06 20:00:00',
                'second_lesson_time' => '2020-01-08 20:00:00',
                'address' => 'ул. Некрасова 18/1',
            ],
        ]);
    }
}
