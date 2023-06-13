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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('franchising_id')->unsigned();
            $table->foreign('franchising_id')->references('id')->on('franchisings');
            $table->unsignedBigInteger('partner_id')->unsigned();
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->decimal('agreements_amount', 10, 2)->default(0);
            $table->decimal('inflow', 10, 2)->default(0);
            $table->decimal('balance_value', 10, 2)->default(0);
            $table->decimal('installment_value', 10, 2)->default(0);
            $table->date('due_date');
            $table->string('installments');
            $table->string('fine');
            $table->string('traffic_ticket');
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
        Schema::dropIfExists('agreements');
    }
};
