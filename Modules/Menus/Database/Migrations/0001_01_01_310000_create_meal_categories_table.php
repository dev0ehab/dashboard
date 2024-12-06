<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Countries\Entities\City;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meal_categories', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('meal_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['meal_category_id', 'locale']);
        });
    }
};
