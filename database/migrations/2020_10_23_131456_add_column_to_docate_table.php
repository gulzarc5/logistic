<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToDocateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('docate', function (Blueprint $table) {
           $table->bigInteger('manifest_id')->nullable()->after('receiver_id');
           $table->bigInteger('baging_id')->nullable()->after('manifest_id');
           $table->bigInteger('sector_id')->nullable()->after('baging_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docate', function (Blueprint $table) {
            //
        });
    }
}
