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
        Schema::table('agreements', function (Blueprint $table) {
            $table->json('json_document')->after('fine')->nullable();
            $table->boolean('sent')->default(0)->after('json_document');
            $table->boolean('generate_document')->default(0)->after('sent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropColumn('json_document');
            $table->dropColumn('sent');
            $table->dropColumn('generate_document');

        });
    }
};
