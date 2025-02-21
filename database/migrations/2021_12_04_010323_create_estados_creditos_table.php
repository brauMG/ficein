<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_de_cuenta_creditos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rfc');
            $table->string('currency');
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
        Schema::dropIfExists('estados_de_cuenta_creditos');
    }
}
