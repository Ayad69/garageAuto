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
        Schema::table('clients', function (Blueprint $table) {
            if (! Schema::hasColumn('clients', 'nomClient')) {
                $table->string('nomClient')->after('user_id');
            }

            if (! Schema::hasColumn('clients', 'prenomClient')) {
                $table->string('prenomClient')->after('nomClient');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $columns = array_values(array_filter([
                Schema::hasColumn('clients', 'nomClient') ? 'nomClient' : null,
                Schema::hasColumn('clients', 'prenomClient') ? 'prenomClient' : null,
            ]));

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
