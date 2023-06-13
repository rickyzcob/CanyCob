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
        Schema::create('charge_historics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('charge_id')->nullable();
            $table->foreign('charge_id')->references('id')->on('charges');
            $table->string('name');
            $table->date('datetime');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('type', ['Phone', 'Email', 'SMS'])->default('Phone');
            $table->enum('success', ['Sim', 'Não']);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('charge_historics');
    }
};
