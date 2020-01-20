<?php

use Illuminate\Database\Seeder;

class TicketEventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('ticket_event_types')->insert([
            ['name'=>'Танго'],
            ['name'=>'Фолк'],
        ]);
    }
}
