<?php

use Illuminate\Database\Seeder;

class TicketCountTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('ticket_count_types')->insert([
           ['name'=>'4 урока','price'=>1000,'lessons_count'=>4,],
           ['name'=>'8 уроков','price'=>1000,'lessons_count'=>8],
           ['name'=>'12 уроков','price'=>1000,'lessons_count'=>12],
           ['name'=>'Разовое посещение','price'=>300,'lessons_count'=>1],
        ]);
    }
}
