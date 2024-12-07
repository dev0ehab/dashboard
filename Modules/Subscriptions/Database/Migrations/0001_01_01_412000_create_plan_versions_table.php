<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Subscriptions\Entities\Plan;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plan::class)->constrained()->cascadeOnDelete();
            $table->integer('number_of_days');
            $table->float('meal_price_per_day');
            $table->float('delivery_price_per_day');
            $table->integer('discount')->default(0);
            $table->float('price');
            $table->enum('subscription_type', ['weekly', 'monthly', 'yearly']);
            $table->timestamps();
        });
    }
};
