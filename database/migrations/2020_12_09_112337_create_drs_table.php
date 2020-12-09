<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drs', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->string('de_name')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('drs_no')->nullable();
            $table->date('drs_date')->nullable();
            $table->time('drs_time')->nullable();
            $table->char('status')->nullable();
            $table->dateTime('drs_close_date_time')->nullable();
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
        Schema::dropIfExists('drs');
    }
}
