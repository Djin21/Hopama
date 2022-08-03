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
        Schema::create('hospitalisations', function (Blueprint $table) {
            $table->id();
            $table->integer('dureePrevue');
            $table->integer('dureeRealisee')->default('-1');
            $table->integer('motif_sortie_id')->default('-1');
            $table->timestamps();

            $table->foreignId('prescription_id')->constrained();
            $table->foreignId('lit_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitalisations');
    }
};
