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
            $table->string('rfc');
            $table->integer('operation_number');
            $table->string('type');
            $table->date('date');
            $table->string('file_pdf');
            $table->timestamps();

            $table->foreign('rfc')->references('rfc')->on('users')->onDelete('cascade');
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
