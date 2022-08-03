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
        Schema::create('lits', function (Blueprint $table) {
            $table->id();
            $table->integer('numero');
            $table->boolean('etat')->default(0); // 1 si le lit est occupee et 0 si non
            $table->timestamps();

            $table->foreignId('salle_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lits');
    }
};
