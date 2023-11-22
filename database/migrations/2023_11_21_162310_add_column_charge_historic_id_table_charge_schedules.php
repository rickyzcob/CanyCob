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
            $table->unsignedBigInteger('charge_historic_id')->after('charge_id')->nullable();
            $table->foreign('charge_historic_id')->references('id')->on('charge_historics');
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
            $table->dropForeign('charge_schedules_charge_historic_id_foreign');
            $table->dropColumn('charge_historic_id');
        });
    }
};
