<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentsTicketTypesLessonsLeft extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_ticket_types_lessons_left', function (Blueprint $table) {

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('ticket_event_type_id');
            $table->integer('lessons_left');

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('ticket_event_type_id')->references('id')->on('ticket_event_types');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
