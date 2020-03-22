<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('ticket_start_date');
            $table->date('ticket_end_date')->nullable();
            $table->timestamp('ticket_bought_date')->useCurrent();
            $table->unsignedBigInteger('ticket_count_type_id')->default(1);
            $table->unsignedBigInteger('ticket_event_type_id')->default(1);
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('teacher_id');
            $table->boolean('is_in_pair')->default(false);
            $table->boolean('is_nullify')->default(true);
            $table->integer('extra_lessons')->default(0);

            $table->timestamps();


            $table->foreign('ticket_count_type_id')->references('id')->on('ticket_count_types');
            $table->foreign('ticket_event_type_id')->references('id')->on('ticket_event_types');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('SET NULL');
            $table->foreign('teacher_id')->references('id')->on('teachers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
