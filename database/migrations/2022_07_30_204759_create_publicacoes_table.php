<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacoes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipo')->unsigned()->default(1);
            $table->integer('id_usuario')->unsigned()->default(1);
            $table->string('titulo');
            $table->string('descricao');
            $table->string('nm_imagem');
            $table->string('path_imagem');
            $table->string('dt_inicio');
            $table->string('dt_fim');
            $table->boolean('ativo')->default(1);
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
        Schema::dropIfExists('publicacoes');
    }
}
