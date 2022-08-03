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
        Schema::create('examen_effectues', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->default('0'); // 0 Si l'examen a ete prescrit, 1 sinon et effectuer par un ancien patient, 2 si effectue par un nouveau patient
            $table->text('resultat')->nullable();
            $table->timestamps();

            $table->foreignId('personnel_id')->constrained();
            $table->foreignId('paiement_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examen_effectues');
    }
};
