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
        Schema::table('partners_franchisings', function (Blueprint $table) {
            $table->unsignedBigInteger('franchising_id')->nullable();
            $table->foreign('franchising_id')->references('id')->on('franchisings');
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners_franchisings', function (Blueprint $table) {
            //
        });
    }
};
