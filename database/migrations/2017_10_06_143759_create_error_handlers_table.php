<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErrorHandlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('error_handlers', function (Blueprint $table) {
        	$table->string('codice');
            $table->primary('codice');
            $table->string('descrizione');
            $table->string('causa');
        });

        DB::table('error_handlers')->insert(['codice' => 'E400', 'descrizione' => 'Errore collettore polvere','causa' => 'Guasto collettore polvere o elemento sporco']);
        DB::table('error_handlers')->insert(['codice' => 'E500', 'descrizione' => 'Microprocessore scheda elettronica non funzionante','causa' => 'Guasto scheda elettronica o fattore esterno (rumore
            ecc.)']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('error_handlers');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
