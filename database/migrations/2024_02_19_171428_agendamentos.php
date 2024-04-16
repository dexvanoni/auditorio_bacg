<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Agendamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('responsavel');
            $table->string('evento');
            $table->date('data_evento');
            $table->string('hora_inicio');
            $table->string('hora_termino');
            $table->integer('qtn_participantes');
            $table->string('contato');
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
        Schema::table('agendamentos', function (Blueprint $table) {
            //
        });
    }
}
