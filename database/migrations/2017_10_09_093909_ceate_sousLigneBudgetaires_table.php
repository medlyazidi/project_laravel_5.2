<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CeateSousLigneBudgetairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sousligneBs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_sousLigneBs');
            $table->string('libelle_ss_ligneB');
            $table->date('dateCreation');
            $table->integer('id_cree_par')->unsigned();
            $table->foreign('id_cree_par')->references('id')->on('users');
            $table->integer('id_ligneB')->unsigned();
            $table->foreign('id_ligneB')->references('id_ligneBudgetaire')->on('ligneBudgetaires');
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
        Schema::drop('sousligneBs');
    }
}
