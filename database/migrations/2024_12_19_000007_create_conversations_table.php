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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->nullable()->constrained('annonces')->onDelete('set null');

            // référence à l'acheteur, mise à null si l'utilisateur est supprimé
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('set null');

            // référence au vendeur, mise à null si l'utilisateur est supprimé
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('set null');

            $table->enum('status', ['ouverte', 'fermee', 'archivee', 'en attente'])->default('ouverte');

            $table->timestamps();
            $table->softDeletes();

            // indexation
            $table->index('annonce_id');
            $table->index('buyer_id');
            $table->index('seller_id');

            // contrainte unique
            $table->unique(['annonce_id', 'buyer_id', 'seller_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
