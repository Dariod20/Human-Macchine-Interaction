<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prenotazione', function(Blueprint $table) {
            $table->id();
            $table->date('arrivo')->unique();
            $table->date('partenza')->unique();
            $table->integer('numAdulti');
            $table->integer('numBambini');
            $table->integer('prezzoTotale');
            $table->string('nome');
            $table->string('cognome');
            $table->string('email');
            $table->string('telefono');
            $table->string('stato');
            $table->time('orarioArrivo');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        // title, author_id

        Schema::create('tariffa', function(Blueprint $table) {
            $table->id();
            $table->date('giorno')->unique();
            $table->integer('prezzo');
            $table->unsignedBigInteger('prenotazione_id')->nullable();
            $table->timestamps();
        });

        Schema::table('tariffa', function(Blueprint $table) {
            $table->foreign('prenotazione_id')->references('id')->on('prenotazione');
        });

        Schema::table('prenotazione', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
