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
        Schema::table('releases', function (Blueprint $table) {
            $table->unsignedBigInteger('type_release_id')->after('tenant_id')->nullable();
            $table->foreign('type_release_id')->references('id')->on('type_releases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('releases', function (Blueprint $table) {
            $table->dropForeign('releases_type_release_id_foreign');
            $table->dropColumn('type_release_id');
        });
    }
};
