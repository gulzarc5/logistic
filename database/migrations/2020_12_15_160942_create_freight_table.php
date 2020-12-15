<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freight', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('warehousing_services')->comment('1=yes,2=no')->nullable();
            $table->char('road_transportation')->comment('1=yes,2=no')->nullable();
            $table->char('air_transportation')->comment('1=yes,2=no')->nullable();
            $table->char('sea_transportaion')->comment('1=yes,2=no')->nullable();
            $table->char('logistic_planning')->comment('1=yes,2=no')->nullable();
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
        Schema::dropIfExists('freight');
    }
}
