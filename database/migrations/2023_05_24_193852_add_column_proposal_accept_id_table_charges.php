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
        Schema::table('charges', function (Blueprint $table) {
            $table->unsignedBigInteger('responsible_id')->unsigned()->after('attendant_id')->nullable();
            $table->foreign('responsible_id')->references('id')->on('users');
            $table->unsignedBigInteger('proposal_accept_id')->unsigned()->after('responsible_id')->nullable();
            $table->foreign('proposal_accept_id')->references('id')->on('proposal_accepts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charges', function (Blueprint $table) {
            //
        });
    }
};
