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
            $table->enum('type', ['A Vista', 'Parcelado sem Entrada', 'Parcelado com Entrada'])->after('id')->default('A Vista');
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
            $table->dropColumn('type');
        });
    }
};
