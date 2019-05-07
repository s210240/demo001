<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class FixPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->integer('hunger')->default(100)->change();
            $table->integer('sleep')->default(100)->change();
            $table->integer('care')->default(100)->change();
            /*$table->dateTime('hunger_time')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
            $table->dateTime('sleep_time')->default(DB::raw('CURRENT_TIMESTAMP'))->change();;
            $table->dateTime('care_time')->default(DB::raw('CURRENT_TIMESTAMP'))->change();;*/
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
