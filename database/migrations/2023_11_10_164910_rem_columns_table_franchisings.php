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
        Schema::table('franchisings', function (Blueprint $table) {
            $table->dropColumn('date_initial');
            $table->dropColumn('date_end');
            $table->dropColumn('date_open');
            $table->dropForeign('franchisings_termination_id_foreign');
            $table->dropColumn('termination_id');
            $table->dropForeign('franchisings_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('franchisings_sale_id_foreign');
            $table->dropColumn('sale_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('franchisings', function (Blueprint $table) {
            //
        });
    }
};
