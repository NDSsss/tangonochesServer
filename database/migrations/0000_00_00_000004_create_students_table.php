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
            $table->string('phone')->unique()->nullable()->default(null);
            $table->string('vk_profile_link')->nullable()->default(null);
            $table->bigInteger('vk_profile_id')->unique()->nullable()->default(null);
            $table->string('facebook_profile_link')->nullable()->default(null);
            $table->bigInteger('facebook_profile_id')->unique()->nullable()->default(null);
            $table->string('instagram_profile_link')->nullable()->default(null);
            $table->bigInteger('instagram_profile_id')->unique()->nullable()->default(null);
            $table->string('photo_link')->nullable()->default(null);
            $table->string('extra_info')->nullable()->default(null);
            $table->string('push_token')->nullable()->default(null);
            $table->integer('barcode_id')->unique()->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();

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
