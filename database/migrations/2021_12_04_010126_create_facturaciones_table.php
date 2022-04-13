<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rfc');
            $table->string('contract_name');
            $table->date('date');
            $table->string('file_pdf')->unique();
            $table->string('file_xml')->unique()->nullable();
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
        Schema::dropIfExists('facturaciones');
    }
}
