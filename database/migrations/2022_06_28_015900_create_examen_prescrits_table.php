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
        Schema::create('examen_prescrits', function (Blueprint $table) {
            $table->id();
            $table->boolean('etatPaiement')->default('0');
            $table->text('resultat')->nullable();
            $table->date('dateRealisation')->nullable();
            $table->timestamps();

            $table->foreignId('prescription_id')->constrained();
            $table->foreignId('examen_id')->constrained();
            $table->foreignId('personnel_id')->constrained()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examen_prescrits');
    }
};
