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
        Schema::create('payment_mehods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('type_release_id');
            $table->foreign('type_release_id')->references('id')->on('type_releases');
            $table->enum('type', ['Cartão Crédito', 'Cartão Débito', 'Pix', 'Boleto', 'Link  de Pagamento']);
            $table->string('code');
            $table->string('bank');
            $table->string('agency');
            $table->string('count');
            $table->enum('status', ['Ativo', 'Inativo']);
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
        Schema::dropIfExists('payment_mehods');
    }
};
