<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Countries\Entities\Country;
use Modules\Subscriptions\Entities\PlanCategory;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Country::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PlanCategory::class)->constrained()->cascadeOnDelete();
            $table->integer('min_calories');
            $table->integer('max_calories');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('plan_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description');
            $table->string('locale')->index();
            $table->unique(['plan_id', 'locale']);
        });
    }
};
