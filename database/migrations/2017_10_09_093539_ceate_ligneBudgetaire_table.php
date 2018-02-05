<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CeateLigneBudgetaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligneBudgetaires', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_ligneBudgetaire');
            $table->string('libelle_ligneB');
            $table->date('dateCreation');
            $table->integer('id_cree_par')->unsigned();
            $table->foreign('id_cree_par')->references('id')->on('users');
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
        Schema::drop('ligneBudgetaires');
    }
}
