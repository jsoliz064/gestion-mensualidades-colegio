<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagoMensualidadDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_mensualidad_detalles', function (Blueprint $table) {
            $table->id();

            $table->integer('gestion');
            $table->string('mes');
            $table->decimal('subtotal', 12, 2);

            $table->unsignedBigInteger('pago_id');
            $table->foreign('pago_id')->references('id')->on('pagos_mensualidades')->onDelete('cascade')->onUpdate('cascade');


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
        Schema::dropIfExists('pago_mensualidad_detalles');
    }
}
