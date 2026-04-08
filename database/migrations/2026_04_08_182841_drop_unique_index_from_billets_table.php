<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('billets', function (Blueprint $table) {
            // First add a regular index so the foreign key doesn't break
            $table->index('id_commande');
            // Then drop the unique index
            $table->dropUnique(['id_commande', 'id_voyage']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('billets', function (Blueprint $table) {
            $table->unique(['id_commande', 'id_voyage']);
        });
    }
};
