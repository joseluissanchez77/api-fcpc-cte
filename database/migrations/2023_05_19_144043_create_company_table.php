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
        Schema::create('company', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nombre', 255)->nullable();
            $table->string('descripcion', 255)->nullable();

            $table->string('ruc', 20)->nullable();
            $table->string('razon_social', 255)->nullable();
            $table->string('razon_comercial', 255)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('emai', 255)->nullable();
            $table->float('procentaje_iva', 8, 2)->nullable();

            $table->timestamps(1);
            $table->softDeletes('deleted_at', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
};
