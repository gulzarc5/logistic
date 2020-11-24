<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cd_no')->nullable();
            $table->string('docate_no')->nullable();
            $table->char('status')->comment('1=pickup,2=drs_prepared,3=drs_closed,4=negative_status')->nullable();
            $table->string('de_name')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->date('drs_date')->nullable();
            $table->time('drs_time')->nullable();
            $table->string('received_by')->nullable();
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->char('negative_status')->nullable();
            $table->date('negative_status_data_time')->nullable();
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
        Schema::dropIfExists('inbound');
    }
}
