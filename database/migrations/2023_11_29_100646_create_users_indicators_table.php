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
        Schema::create('users_indicators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
//            $table->unsignedBigInteger('level01_id')->nullable();
//            $table->foreign('level01_id')->references('id')->on('users');
//            $table->unsignedBigInteger('level02_id')->nullable();
//            $table->foreign('level02_id')->references('id')->on('users');
//            $table->unsignedBigInteger('level03_id')->nullable();
//            $table->foreign('level03_id')->references('id')->on('users');
//            $table->unsignedBigInteger('level04_id')->nullable();
//            $table->foreign('level04_id')->references('id')->on('users');
//            $table->unsignedBigInteger('level05_id')->nullable();
//            $table->foreign('level05_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_indicators');
    }
};
