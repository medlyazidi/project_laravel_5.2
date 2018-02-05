<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deputes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_depute');
            $table->string('nom');
            $table->string('prenom');
            $table->enum('sexe', array('Monsion.', 'Madamae.'));
            $table->string('photo');
            $table->date('dateCreation');
            $table->integer('id_cree_par')->unsigned();
            $table->foreign('id_cree_par')->references('id')->on('users');
            $table->integer('id_typeDeputes')->unsigned();
            $table->foreign('id_typeDeputes')->references('id_typeDepute')->on('typeDeputes');
            $table->integer('id_local')->unsigned();
            $table->foreign('id_local')->references('id_local')->on('locals');
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
        Schema::drop('deputes');
    }
}
