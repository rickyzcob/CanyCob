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
            $table->string('corporate_name')->after('name')->change();
            $table->string('employer_number')->after('corporate_name')->change();
            $table->string('state_registration')->after('employer_number')->change();

            $table->string('cep')->after('state_registration')->change();
            $table->renameColumn('cep', 'zip_code');


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
