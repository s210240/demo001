<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->integer('id')->index();
            $table->integer('id_user');
            $table->string('pet_type');
            $table->integer('hunger')->default(0);
            $table->integer('sleep')->default(0);
            $table->integer('care')->default(0);
            $table->dateTime('hunger_time');
            $table->dateTime('sleep_time');
            $table->dateTime('care_time');
            $table->integer('die')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
