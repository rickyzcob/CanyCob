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
        Schema::table('charge_historics', function (Blueprint $table) {
            $table->string('whatsapp')->after('email');
            $table->enum('type', ['Phone', 'Email', 'SMS', 'WhatsApp'])->default('Phone')->after('whatsapp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charge_historics', function (Blueprint $table) {
            //
        });
    }
};
