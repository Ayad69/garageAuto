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
        Schema::create('reparations', function (Blueprint $table) {
            $table->id();
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->enum('status', ['en_cours', 'fini', 'attente'])->default('attente');
            $table->unsignedBigInteger('vehicule_id');


            $table->foreign('vehicule_id')->references('id')->on('vehicules');
            $table->unsignedBigInteger('typeReparation_id');
            $table->foreign('typeReparation_id')->references('id')->on('typeReparations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reparations');
    }
};
