<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToDocateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('docate', function (Blueprint $table) {
            $table->string('manifest_no')->nullable()->after('chargeable_weight');
            $table->timestamp('manifest_date')->nullable()->after('manifest_no');
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
