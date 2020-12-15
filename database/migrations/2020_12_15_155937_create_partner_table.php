<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('partner_type')->comment('1=delivery executive,2=franchise partner')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('phone')->nullable();
            $table->string('city')->nullable();
            $table->char('bike')->comment('1=mini van,2=lcv truck,3=cycle')->nullable();
            $table->string('state')->nullable();
            $table->string('special_info')->nullable();
            $table->string('email_address')->nullable();
            $table->bigInteger('freight_id')->nullable();
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
        Schema::dropIfExists('partner');
    }
}
