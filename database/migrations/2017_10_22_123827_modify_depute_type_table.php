<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDeputeTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_deputes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_typeDepute');
            $table->string('libelle_typeDepute');
            $table->timestamps();
        });

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
            $table->integer('id_local')->unsigned();
            $table->foreign('id_local')->references('id_local')->on('locals');
            $table->timestamps();
        });

        Schema::create('union_depute_type', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_union_depute_type');
            $table->integer('id_typeDepute')->unsigned();
            $table->foreign('id_typeDepute')->references('id_typeDepute')->on('type_deputes');
            $table->integer('id_depute')->unsigned();
            $table->foreign('id_depute')->references('id_depute')->on('deputes');
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
        Schema::drop('type_deputes');
        Schema::drop('deputes');
        Schema::drop('union_depute_type');
    }
}
