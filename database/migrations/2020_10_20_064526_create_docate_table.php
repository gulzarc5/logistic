<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('docate_id');
            $table->string('paymen_option')->comment('c = credit, cod= Topay, cash = cash');
            $table->double('collecting_amount')->nullable();
            $table->bigInteger('origin')->comment('city_id');
            $table->string('send_mode')->comment('Air,City,Road');
            $table->double('no_of_box');
            $table->bigInteger('receiver_id');
            $table->bigInteger('sender_id');
            $table->string('actual_weight');
            $table->string('chargeable_weight');
            $table->string('invoice_value');
            $table->char('staus')->comment('1=New, 2=Manifested,3=Bagged,4=Sector Booked');
            $table->bigInteger('branch_id');
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
        Schema::dropIfExists('docate');
    }
}
