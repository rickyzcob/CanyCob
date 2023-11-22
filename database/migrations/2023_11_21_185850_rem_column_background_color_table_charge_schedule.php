<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('charge_schedules', function (Blueprint $table) {
            $table->dropColumn('backgroundColor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charge_schedules', function (Blueprint $table) {
            $table->string('backgroundColor')->after('start')->nullable();
        });
    }
};
