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
        foreach (Schema::getIndexes('clients') as $index) {
            if (($index['unique'] ?? false) && ($index['columns'] ?? []) === ['user_id']) {
                Schema::table('clients', function (Blueprint $table) use ($index) {
                    $table->dropUnique($index['name']);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unique('user_id');
        });
    }
};
