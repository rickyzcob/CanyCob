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
        Schema::table('proposal_accepts', function (Blueprint $table) {
            $table->dropForeign('proposal_accepts_charge_id_foreign');
            $table->dropColumn('charge_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposal_accepts', function (Blueprint $table) {
            //
        });
    }
};
