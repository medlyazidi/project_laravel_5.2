<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRessourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ressources', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_ressource');
            $table->double('montant');
            $table->dateTime('date');
            $table->text('descriptif');

            $table->integer('id_type_ressouurce')->unsigned();
            $table->foreign('id_type_ressouurce')->references('id_type_ressouurce')->on('type_ressouurces');

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
        Schema::drop('ressources');
    }
}
