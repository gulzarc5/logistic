<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docate_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('docate_id');
            $table->string('name');
            $table->bigInteger('state')->comment('state_id');
            $table->bigInteger('city')->comment('city_id');
            $table->double('pin');
            $table->string('address');
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
        Schema::dropIfExists('docate_details');
    }
}
