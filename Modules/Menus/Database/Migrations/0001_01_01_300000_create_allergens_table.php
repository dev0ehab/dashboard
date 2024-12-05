<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Countries\Entities\City;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('allergens', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('allergen_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('allergen_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['allergen_id', 'locale']);
        });
    }
};
