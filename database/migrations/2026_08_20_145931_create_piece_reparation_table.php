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
        Schema::create('piece_reparation', function (Blueprint $table) {
            $table->unsignedBigInteger('piece_id');
            $table->foreign('piece_id')->references('id')->on('pieces');
            $table->unsignedBigInteger('reparation_id');
            $table->foreign('reparation_id')->references('id')->on('reparations');
            $table->integer('quantite');
            $table->primary(['piece_id', 'reparation_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piece_reparation');
    }
};
