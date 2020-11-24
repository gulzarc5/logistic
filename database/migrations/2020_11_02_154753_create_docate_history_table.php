<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docate_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('docate_id')->nullable();
            $table->char('type')->comment('1=New,2=Manifested,3=Bagged,4=Sector Booked,5=Pickup,6=Remanifested,7=Out For Delivery,8=Delivered')->nullable();
            $table->bigInteger('data_id')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('docate_history');
    }
}
