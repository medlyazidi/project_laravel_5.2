<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mode_paiements', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_mode_paiement');
            $table->string('libelle_mode_paiement');
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
        Schema::drop('mode_paiements');
    }
}
