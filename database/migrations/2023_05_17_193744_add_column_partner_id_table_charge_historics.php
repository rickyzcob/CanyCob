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
        Schema::table('charge_historics', function (Blueprint $table) {
            $table->unsignedBigInteger('partner_id')->after('charge_id');
            $table->foreign('partner_id')->references('id')->on('partners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charge_historics', function (Blueprint $table) {
            $table->dropForeign('charge_historics_partner_id_foreign');
            $table->dropColumn('partner_id');
        });
    }
};
