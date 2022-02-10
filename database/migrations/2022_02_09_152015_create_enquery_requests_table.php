<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnqueryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquery_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source_state',255)->nullable();
            $table->string('source_city',255)->nullable();
            $table->string('source_pin',255)->nullable();
            $table->string('source_area',255)->nullable();
            $table->string('source_address',255)->nullable();
            $table->string('destination_state',255)->nullable();
            $table->string('destination_city',255)->nullable();
            $table->string('destination_pin',255)->nullable();
            $table->string('destination_area',255)->nullable();
            $table->string('destination_address',255)->nullable();
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
        Schema::dropIfExists('enquery_requests');
    }
}
