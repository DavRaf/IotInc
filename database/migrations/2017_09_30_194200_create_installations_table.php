<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstallationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sitoMonitoraggio');
            $table->string('citta')->nullable();
            $table->string('indirizzo')->nullable();
            $table->string('descrizione')->nullable();
            $table->integer('idCliente')->unsigned()->nullable();
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

        Schema::dropIfExists('installations');
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
