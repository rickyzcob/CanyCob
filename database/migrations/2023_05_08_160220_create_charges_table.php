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
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('franchising_id')->nullable();
            $table->foreign('franchising_id')->references('id')->on('franchisings');
            $table->unsignedBigInteger('attendant_id')->nullable();
            $table->foreign('attendant_id')->references('id')->on('users');
            $table->double('total_amount', 10, 2)->default(0);
            $table->double('total_amount_corrected', 10, 2)->default(0);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('charges');
    }
};
