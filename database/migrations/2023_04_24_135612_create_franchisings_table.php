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
        Schema::create('franchisings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('attendant_id')->nullable();
            $table->foreign('attendant_id')->references('id')->on('users');

            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('franchising_statuses');

            $table->unsignedBigInteger('termination_id')->nullable();
            $table->foreign('termination_id')->references('id')->on('type_termination_franchisings');

            $table->unsignedBigInteger('sale_id')->nullable();
            $table->foreign('sale_id')->references('id')->on('type_sales_franchisings');

            $table->string('name');
            $table->string('supervisor')->nullable();
            $table->string('cadeiras_ativas')->nullable();
            $table->string('cadeiras_capacidade')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('cep')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('bairro')->nullable();
            $table->string('regiao')->nullable();
            $table->string('google_maps')->nullable();
            $table->string('populacao')->nullable();
            $table->string('cluster')->nullable();
            $table->string('country')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('cro')->nullable();
            $table->string('insc')->nullable();
            $table->string('responsavel_tecnico')->nullable();
            $table->string('responsavel_tecnico_cro')->nullable();
            $table->string('phone01')->nullable();
            $table->string('phone02')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('email_site')->nullable();
            $table->date('date_initial')->nullable();
            $table->date('date_end')->nullable();
            $table->date('date_open')->nullable();
            $table->date('date_termination')->nullable();
            $table->date('deadline_opening')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 100)->nullable();
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
        Schema::dropIfExists('franchisings');
    }
};
