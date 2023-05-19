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
        Schema::create('point_emission', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('numero_punto_emision', 255)->nullable();
            $table->string('nombre', 255)->nullable();

            $table->bigInteger('establishment_id')->unsigned();
            $table->foreign('establishment_id')->references('id')->on('establishment');

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
        Schema::dropIfExists('point_emission');
    }
};
