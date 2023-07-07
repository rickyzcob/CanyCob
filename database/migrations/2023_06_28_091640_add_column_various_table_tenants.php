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
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('corporate_name')->after('id')->nullable();
            $table->string('state_registration')->after('name')->nullable();
            $table->string('entities_number')->after('state_registration')->nullable();
            $table->string('document')->after('entities_number')->nullable();
            $table->string('zip_code')->after('document')->nullable();
            $table->string('address')->after('zip_code')->nullable();
            $table->string('number')->after('address')->nullable();
            $table->string('complement')->after('number')->nullable();
            $table->string('neighborhood')->after('complement')->nullable();
            $table->string('city')->after('neighborhood')->nullable();
            $table->string('uf')->after('city')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('corporate_name');
            $table->dropColumn('state_registration');
            $table->dropColumn('entities_number');
            $table->dropColumn('document');
            $table->dropColumn('zip_code');
            $table->dropColumn('address');
            $table->dropColumn('number');
            $table->dropColumn('complement');
            $table->dropColumn('neighborhood');
            $table->dropColumn('city');
            $table->dropColumn('uf');
        });
    }
};
