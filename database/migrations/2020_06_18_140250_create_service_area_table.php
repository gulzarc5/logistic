<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_area', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area_name');
            $table->bigInteger('state_id');
            $table->bigInteger('city_id');
            $table->string('pin');
            $table->char('status',1)->default('1')->comment('1 = active, 2 = deactive');
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
        Schema::dropIfExists('service_area');
    }
}
