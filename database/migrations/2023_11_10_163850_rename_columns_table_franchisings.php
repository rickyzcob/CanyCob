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
            $table->renameColumn('bairro', 'neighborhood');
            $table->renameColumn('regiao', 'region');
            $table->renameColumn('razao_social', 'corporate_name');
            $table->renameColumn('cnpj', 'employer_number');
            $table->renameColumn('insc', 'state_registration');
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
