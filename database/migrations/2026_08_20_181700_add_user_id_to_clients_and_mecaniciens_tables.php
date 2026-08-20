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
            if (! Schema::hasColumn('clients', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained();
            }
        });

        foreach (['nomClient', 'prenomClient', 'mailClient'] as $column) {
            if (Schema::hasColumn('clients', $column)) {
                Schema::table('clients', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }

        Schema::table('mecaniciens', function (Blueprint $table) {
            if (! Schema::hasColumn('mecaniciens', 'user_id')) {
                $table->foreignId('user_id')->after('id')->unique()->constrained();
            }
        });

        foreach (['nomMecanicien', 'prenomMecanicien', 'login', 'password'] as $column) {
            if (Schema::hasColumn('mecaniciens', $column)) {
                Schema::table('mecaniciens', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
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
            if (Schema::hasColumn('clients', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }

            if (! Schema::hasColumn('clients', 'nomClient')) {
                $table->string('nomClient')->nullable();
                $table->string('prenomClient')->nullable();
                $table->string('mailClient')->nullable();
            }
        });

        Schema::table('mecaniciens', function (Blueprint $table) {
            if (Schema::hasColumn('mecaniciens', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }

            if (! Schema::hasColumn('mecaniciens', 'nomMecanicien')) {
                $table->string('nomMecanicien')->nullable();
                $table->string('prenomMecanicien')->nullable();
                $table->string('login')->nullable();
                $table->string('password')->nullable();
            }
        });
    }
};
