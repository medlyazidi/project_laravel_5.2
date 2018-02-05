<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatCompteBancaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banques', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_banque');
            $table->string('libelle_banque');
            $table->date('dateAjout');
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
        Schema::drop('compteBancaire');
    }
}
