<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traces', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_trace');
            $table->enum('operation', array('ajouter', 'modifier','supprimer'));
            $table->string('table');
            $table->string('info');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::drop('traces');
    }
}
