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
        Schema::table('template_proposals', function (Blueprint $table) {
            $table->enum('type',['Cobrança', 'Formal'])->default('Cobrança')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_proposals', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
