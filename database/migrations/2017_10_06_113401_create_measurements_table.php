<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->increments('numero');
            $table->integer('idSensore')->unsigned();
            $table->string('stringaRilevazione');
            $table->string('data')->nullable();
            $table->string('ora')->nullable();
            $table->double('valore',15,8)->nullable();
            $table->string('descrizione')->nullable();
            $table->string('codiceErrore')->nullable();
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

        Schema::dropIfExists('measurements');
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
