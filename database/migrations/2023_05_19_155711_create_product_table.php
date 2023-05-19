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
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nombre', 255)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->string('categoria', 255)->nullable();
            $table->string('codigo', 255)->nullable();
            $table->bigInteger('stock')->nullable();
            $table->decimal('precio', 8, 2)->nullable();

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
        Schema::dropIfExists('product');
    }
};
