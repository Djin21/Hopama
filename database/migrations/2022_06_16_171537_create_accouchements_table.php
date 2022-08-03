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
        Schema::create('accouchements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained();
            $table->boolean('decesPatient')->default('0');
            $table->integer('nbrEnfant')->default('1');
            $table->integer('nbrDeces')->default('0');
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
        Schema::dropIfExists('accouchements');
    }
};
