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
            $table->unsignedBigInteger('agreement_id')->after('charge_id')->nullable();
            $table->foreign('agreement_id')->references('id')->on('agreements');
            $table->string('parcel')->after('due_date')->nullable();
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
            $table->dropForeign('releases_agreement_id_foreign');
            $table->dropColumn('agreement_id');
            $table->dropColumn('parcel');
        });
    }
};
