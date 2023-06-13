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
        Schema::create('releases', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('cnpj')->nullable();
            $table->unsignedBigInteger('franchising_id')->nullable();
            $table->foreign('franchising_id')->references('id')->on('franchisings');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('release_statuses');
            $table->string('account')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('due_date');
            $table->string('emp_tp_processo')->nullable();;
            $table->string('month')->nullable();
            $table->double('amount', 10, 2)->default(0);
            $table->double('amount_paid', 10, 2)->default(0);
            $table->boolean('recurrent')->nullable();
            $table->boolean('franchisee')->nullable();
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
        Schema::dropIfExists('releases');
    }
};
