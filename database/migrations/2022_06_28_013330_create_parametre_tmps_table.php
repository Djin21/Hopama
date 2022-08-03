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
        Schema::create('parametre_tmps', function (Blueprint $table) {
            $table->id();
            $table->integer('temperature');
            $table->integer('tension');
            $table->integer('poids');
            $table->integer('taille');
            $table->timestamps();

            $table->foreignId('patient_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametre_tmps');
    }
};
