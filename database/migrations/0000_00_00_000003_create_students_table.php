<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('vk_profile_link')->nullable();
            $table->bigInteger('vk_profile_id')->unique()->nullable();
            $table->string('facebook_profile_link')->nullable();
            $table->bigInteger('facebook_profile_id')->nullable()->unique();
            $table->string('instagram_profile_link')->nullable();
            $table->bigInteger('instagram_profile_id')->nullable()->unique();
            $table->string('photo_link')->nullable();
            $table->string('extra_info')->nullable();
            $table->string('push_token')->nullable();
            $table->integer('barcode_id')->unique()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
