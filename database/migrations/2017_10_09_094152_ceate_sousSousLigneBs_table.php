<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CeateSousSousLigneBsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sousSousligneBs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_sousSousligneBs');
            $table->string('libelle_ss_ss_ligneB');
            $table->date('dateCreation');
            $table->integer('id_cree_par')->unsigned();
            $table->foreign('id_cree_par')->references('id')->on('users');
            $table->integer('id_ss_ligneB')->unsigned();
            $table->foreign('id_ss_ligneB')->references('id_sousLigneBs')->on('sousligneBs');
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
        Schema::drop('sousSousligneBs');
    }
}
