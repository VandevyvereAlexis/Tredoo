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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('restrict');
            $table->foreignId('car_model_id')->nullable()->constrained('car_models')->onDelete('restrict');

            $table->string('title', 150);
            $table->boolean('sold')->default(false);
            $table->boolean('visible')->default(true);
            $table->boolean('first_hand')->default(false);
            $table->decimal('price', 9, 2);
            $table->integer('mileage');
            $table->integer('fiscal_power');
            $table->integer('horsepower');
            $table->date('first_registration_date');
            $table->string('city', 100);
            $table->char('postal_code', 5);
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->text('description');

            $table->enum('fuel', [
                'essence',
                'diesel',
                'hybride',
                'electrique',
                'gpl',
                'gaz_naturel_cgn',
                'autre',
            ])->default('autre');

            $table->enum('transmission', [
                'automatique',
                'manuelle',
            ])->default('manuelle');

            $table->enum('type', [
                '4x4_suv_crossover',
                'Citadine',
                'berline',
                'break',
                'cabriolet',
                'coupé',
                'monospace_minibus',
                'commerciale_société',
                'sans_permis',
                'autre',
            ])->default('autre');

            $table->enum('doors', [
                '3_portes',
                '4_portes',
                '5_portes',
                '6_portes_ou_plus',
            ])->default('5_portes');

            $table->enum('seats', [
                '1_place',
                '2_places',
                '3_places',
                '4_places',
                '5_places',
                '6_places',
                '7_ou_plus',
            ])->default('5_places');

            $table->enum('color', [
                'blanc',
                'noir',
                'gris',
                'argent',
                'bleu',
                'rouge',
                'vert',
                'marron',
                'beige',
                'jaune',
                'autre',
            ])->default('autre');

            $table->enum('condition', [
                'sans_frais_a_prevoir',
                'roulante_reparation_a_prevoir',
                'non_roulante',
                'accidentee',
                'pour_pieces',
            ])->default('sans_frais_a_prevoir');

            $table->enum('crit_air', [
                'crit_air_1',
                'crit_air_2',
                'crit_air_3',
                'crit_air_4',
                'crit_air_5',
                'non_classe',
            ])->default('non_classe');

            $table->enum('emission_class', [
                'euro_1',
                'euro_2',
                'euro_3',
                'euro_4',
                'euro_5',
                'euro_6',
                'autre',
            ])->default('autre');

            $table->timestamps();
            $table->softDeletes();

            // indexation
            $table->index('brand_id');
            $table->index('car_model_id');
            $table->index('price');
            $table->index('mileage');
            $table->index('type');
            $table->index('fuel');
            $table->index('transmission');
            $table->index(['city', 'postal_code']);
            $table->index(['latitude', 'longitude']);

            // contrainte unique
            $table->unique(['user_id', 'title', 'first_registration_date',]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
