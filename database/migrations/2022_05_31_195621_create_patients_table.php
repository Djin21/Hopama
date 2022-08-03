<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->boolean('sexe')->default(0);
            $table->date('dateNaiss')->nullable();
            $table->string('lieuNaiss')->nullable();
            $table->integer('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('profession')->nullable();
            $table->boolean('statutMatrimonial')->default('0'); // 1 : marier, 0 : celibataire
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
        Schema::dropIfExists('patients');
    }
};
