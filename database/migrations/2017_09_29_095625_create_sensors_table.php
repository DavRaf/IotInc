<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('marca');
            $table->string('tipo');
            $table->string('modello');
            $table->string('codice');
            $table->string('descrizione')->nullable();
            $table->enum('stato', ['attivo', 'disabilitato'])->default('attivo');    
            $table->integer('idImpianto')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('sensors');
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}

