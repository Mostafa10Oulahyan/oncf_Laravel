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
        Schema::table('billets', function (Blueprint $table) {
            $table->string('nom_passager')->nullable();
            $table->string('prenom_passager')->nullable();
            $table->string('cin_passager')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('billets', function (Blueprint $table) {
            $table->dropColumn(['nom_passager', 'prenom_passager', 'cin_passager']);
        });
    }
};
