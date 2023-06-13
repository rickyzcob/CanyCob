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
        Schema::create('contacts_franchisings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('franchising_id');
            $table->foreign('franchising_id')->references('id')->on('franchisings');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
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
        Schema::dropIfExists('contacts_franchisings');
    }
};
