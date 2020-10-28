<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_booking', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('manifest_id')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->string('booked_by')->nullable();
            $table->string('co_loader_name')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('mode')->nullable();
            $table->string('cd_no')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->date('dep_date')->nullable();
            $table->time('dep_time')->nullable();
            $table->date('arr_date')->nullable();
            $table->time('arr_time')->nullable();
            $table->string('auto_generate_no')->nullable();
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
        Schema::dropIfExists('sector_booking');
    }
}
