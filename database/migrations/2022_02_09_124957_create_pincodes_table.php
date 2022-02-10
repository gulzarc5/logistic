<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pincodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pincode',10)->nullable();
            $table->string('area',100)->nullable();
            $table->char('status',1)->default(1)->comment('1:active,2:not-active');
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
        Schema::dropIfExists('pincodes');
    }
}
