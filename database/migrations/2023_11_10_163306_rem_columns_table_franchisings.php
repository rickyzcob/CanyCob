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
            $table->dropColumn('supervisor');
            $table->dropColumn('cadeiras_ativas');
            $table->dropColumn('cadeiras_capacidade');
            $table->dropColumn('populacao');
            $table->dropColumn('cluster');
            $table->dropColumn('cro');
            $table->dropColumn('responsavel_tecnico');
            $table->dropColumn('responsavel_tecnico_cro');
            $table->dropColumn('date_termination');
            $table->dropColumn('deadline_opening');
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
