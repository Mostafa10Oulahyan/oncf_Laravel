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
        Schema::create('billets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_commande');
            $table->unsignedBigInteger('id_voyage');
            $table->string('qte');
            $table->string('nom_passager')->nullable();
            $table->string('prenom_passager')->nullable();
            $table->string('cin_passager')->nullable();
            $table->foreign('id_commande')->references('id')->on("commandes")->onDelete('cascade');
            $table->foreign('id_voyage')->references('id')->on("voyages")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billets');
    }
};
