<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_depense');
            $table->string('solde');
            $table->integer('id_compte')->unsigned();
            $table->foreign('id_compte')->references('id_compte')->on('comptes');
            $table->integer('id_cree_par')->unsigned();
            $table->foreign('id_cree_par')->references('id')->on('users');
            $table->integer('id_ligneB')->unsigned();
            $table->foreign('id_ligneB')->references('id_ligneBudgetaire')->on('ligne_budgetaires');
            $table->integer('id_ss_ligneB')->unsigned();
            $table->foreign('id_ss_ligneB')->references('id_sousLigneBs')->on('sous_ligne_bs');
            $table->integer('id_ss_ss_ligneB')->unsigned();
            $table->foreign('id_ss_ss_ligneB')->references('id_sousSousligneBs')->on('sous_sous_ligne_bs');
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
        Schema::drop('depenses');
    }
}
