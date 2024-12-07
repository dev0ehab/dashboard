<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Menus\Entities\MealCategory;
use Modules\Subscriptions\Entities\Plan;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plan::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(MealCategory::class)->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->timestamps();
        });
    }
};
