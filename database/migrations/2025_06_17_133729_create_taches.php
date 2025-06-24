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
         Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->dateTime('date_debut');
            $table->dateTime('date_echeance');
            $table->enum('priorite', ['basse', 'moyenne', 'haute'])->default('moyenne');
            $table->string('categorie');
            $table->string('entreprise');
            $table->text('description');
            $table->enum('statut', ['en_attente', 'en_cours', 'terminee', 'annulee', 'reportee'])->default('en_attente');
            $table->text('commentaire')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
