<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(StudentsSeeder::class);
         $this->call(TeachersSeeder::class);
         $this->call(TicketCountTypesSeeder::class);
         $this->call(TicketEventTypeSeeder::class);
         $this->call(GroupsSeeder::class);
         $this->call(LessonsSeeder::class);
         $this->call(LessonsStudentsSeeder::class);
         $this->call(LessonsTeachersSeeder::class);
         $this->call(TicketsSeeder::class);
         $this->call(StudentsTicketTypesLessonsLeftSeeder::class);
         $this->call(EventAnnounceSeeder::class);
         $this->call(LessonAnnounceSeeder::class);
    }
}
