<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero');
            $table->integer('numero_ticket')->comment("numero generado por dia");
            $table->dateTime('fecha');
            $table->text('concepto')->nullable();

            $table->string('nit', 20)->nullable();
            $table->string('razon_social', 100)->nullable();

            $table->boolean('estado')->value(true);

            //clave foranea
            $table->unsignedInteger('users_id');
            $table->foreign('users_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            //clave foranea
            $table->unsignedInteger('clients_id');
            $table->foreign('clients_id')
                    ->references('id')->on('clients')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('sales');
    }
}
