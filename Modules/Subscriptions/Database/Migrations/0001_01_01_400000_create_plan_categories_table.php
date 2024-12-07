<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_categories', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('plan_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['plan_category_id', 'locale']);
        });
    }
};
