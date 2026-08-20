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
        Schema::create('mecanicien_diagnostic', function (Blueprint $table) {
            $table->unsignedBigInteger('mecanicien_id');
            $table->unsignedBigInteger('diagnostic_id');
            $table->primary(['mecanicien_id', 'diagnostic_id']);
            $table->date('dateIntervention');
            $table->string('commentaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mecanicien_diagnostic');
    }
};
