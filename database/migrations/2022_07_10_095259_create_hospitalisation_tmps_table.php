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
        Schema::create('hospitalisation_tmps', function (Blueprint $table) {
            $table->id();
            $table->integer('dureePrevue');
            $table->integer('dureeRealisee')->default('-1');
            $table->integer('motif_sortie_id')->default('-1');
            $table->integer('prescription_id')->default('-1');
            $table->integer('lit_id')->default('-1');
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
        Schema::dropIfExists('hospitalisation_tmps');
    }
};
