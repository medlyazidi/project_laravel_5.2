<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeDeputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typeDeputes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_typeDepute');
            $table->string('libelle_typeDepute');
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
        Schema::drop('typeDeputes');
    }
}
