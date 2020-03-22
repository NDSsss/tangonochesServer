<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTicketTypesLessonsLeftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_ticket_types_lessons_lefts', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('ticket_event_type_id');
            $table->unsignedBigInteger('ticket_id')->default(1)->nullable();
            $table->integer('lessons_left');

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets');
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
        Schema::dropIfExists('students_ticket_types_lessons_lefts');
    }
}
