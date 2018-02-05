<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotisations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_cotisation');
            $table->double('montant');
            $table->dateTime('date_reception');
            $table->dateTime('date_encaissement');

            $table->integer('id_mode_paiement')->unsigned();
            $table->foreign('id_mode_paiement')->references('id_mode_paiement')->on('mode_paiements');

            $table->integer('id_depute')->unsigned();
            $table->foreign('id_depute')->references('id_depute')->on('deputes');

            $table->integer('id_compte')->unsigned();
            $table->foreign('id_compte')->references('id_compte')->on('comptes');

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
        Schema::drop('cotisations');
    }
}
