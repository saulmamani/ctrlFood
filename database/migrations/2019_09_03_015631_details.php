<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Details extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad');

            //clave foranea
            $table->unsignedInteger('sales_id');
            $table->foreign('sales_id')
                    ->references('id')->on('sales')
                    ->onDelete('cascade');

            //clave foranea
            $table->unsignedInteger('products_id');
            $table->foreign('products_id')
                    ->references('id')->on('products')
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
        Schema::dropIfExists('details');
    }
}
