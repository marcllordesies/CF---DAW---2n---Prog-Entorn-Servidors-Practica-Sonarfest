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
        // Creem la taula d'artistas
        Schema::create('artistas', function (Blueprint $table) {
            // id (bigIncrements, PK) -> Laravel ho fa automàticament amb id()
            $table->id();

            // nom (string, not null)
            $table->string('nom');

            // pais (string, not null)
            $table->string('pais');

            // bio (text, nullable)
            $table->text('bio')->nullable();

            // imatge_url (string, nullable)
            $table->string('imatge_url')->nullable();

            // actiu (boolean, default true)
            $table->boolean('actiu')->default(true);

            // timestamps (created_at + updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artistas');
    }
};
