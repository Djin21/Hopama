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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->text('symptomes')->nullable();
            $table->text('notes')->nullable();
            $table->integer('etat')->default(0);
            $table->date('dateRealisation')->nullable();
            $table->text('resultat')->nullable();
            $table->timestamps();

            $table->foreignId('session_id')->constrained();
            $table->foreignId('personnel_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};
