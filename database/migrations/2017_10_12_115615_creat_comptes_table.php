<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatComptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_compte');
            $table->string('numero_banque');
            $table->string('nom_banque');
            $table->string('sugnataire');
            $table->date('dateAjout');
            $table->date('dateOuvrageCompte');
            $table->integer('id_cree_par')->unsigned();
            $table->foreign('id_cree_par')->references('id')->on('users');
            $table->integer('id_banque')->unsigned();
            $table->foreign('id_banque')->references('id_banque')->on('banques');
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
        Schema::drop('comptes');
    }
}
