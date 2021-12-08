<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContanciaInversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constacias_de_inversion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_client');
            $table->integer('operation_number');
            $table->string('type');
            $table->date('date');
            $table->string('file_pdf');
            $table->timestamps();

            $table->foreign('id_client')->references('id_client')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constacias_de_inversion');
    }
}
