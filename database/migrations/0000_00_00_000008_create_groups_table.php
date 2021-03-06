<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamp('first_lesson_time')->nullable();
            $table->timestamp('second_lesson_time')->nullable();
            $table->unsignedBigInteger('ticket_event_type_id')->default(1);
            $table->string('address')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ticket_event_type_id')->references('id')->on('ticket_event_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
