<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Countries\Entities\City;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->string('address');
            $table->string('lat');
            $table->string('long');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('menu_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['menu_id', 'locale']);
        });
    }
};
