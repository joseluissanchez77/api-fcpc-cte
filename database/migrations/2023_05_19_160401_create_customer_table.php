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
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('primer_nombre', 255)->nullable();
            $table->string('segundo_nombre', 255)->nullable();
            $table->string('primer_apellido', 255)->nullable();
            $table->string('segundo_apellido', 255)->nullable();
            $table->string('tipo_identificacion', 255)->nullable();
            $table->string('identificacion', 255)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('correo', 255)->nullable();
            $table->string('telefono', 255)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->bigInteger('edad')->nullable();

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
        Schema::dropIfExists('customer');
    }
};
