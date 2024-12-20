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
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('role_id')->default(1)->constrained('roles')->onDelete('restrict');

            // compte vérifié
            $table->timestamp('email_verified_at')->nullable();

            // informations de base
            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('username', 50)->unique();
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->string('profile_image', 255)->default('default.jpg');

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // réinitialisation de mot de passe
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // suivi connexions des utilisateurs
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // cascade
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};