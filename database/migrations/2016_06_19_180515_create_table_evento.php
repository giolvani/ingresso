<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organizador_id')->index();
            $table->string('nome');
            $table->dateTime('data_inicial');
            $table->dateTime('data_final');
            $table->string('descricao', 500);
            $table->integer('lotacao_maxima');
            $table->enum('tipo', ['show', 'balada', 'teatro', 'esporte']);
            $table->boolean('publicado');
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
        Schema::drop('eventos');
    }
}
