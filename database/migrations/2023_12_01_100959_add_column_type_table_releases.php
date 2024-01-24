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
        Schema::table('releases', function (Blueprint $table) {
            $table->unsignedBigInteger('charge_amount_release_id')->after('charge_id')->nullable();
            $table->foreign('charge_amount_release_id')->references('id')->on('charge_amount_releases');
            $table->enum('type', ['Cartão Crédito', 'Cartão Débito', 'Pix', 'Boleto', 'Link  de Pagamento'])->after('id')->nullable();
            $table->string('bill')->after('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('releases', function (Blueprint $table) {
            $table->dropForeign('releases_charge_amount_release_id_foreign');
            $table->dropColumn('charge_amount_release_id');
            $table->dropColumn('type');
            $table->dropColumn('bill');
        });
    }
};
