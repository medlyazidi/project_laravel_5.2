<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeRessouurcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_ressouurces', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_type_ressouurce');
            $table->string('libelle_type_ressouurce');
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
        Schema::drop('type_ressouurces');
    }
}
