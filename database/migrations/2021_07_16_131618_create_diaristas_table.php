<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaristasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaristas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->char('cpf', 11);
            $table->string('email', 100);
            $table->char('telefone', 11);
            $table->string('logradouro');
            $table->string('numero', 20);
            $table->string('complemento', 50)->nullable();
            $table->string('bairro', 50);
            $table->char('cidade', 50);
            $table->char('estado', 2);
            $table->char('cep', 8);
            $table->integer('codigo_ibge');
            $table->string('foto_usuario');
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
        Schema::dropIfExists('diaristas');
    }
}
