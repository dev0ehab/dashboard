<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Admins\Entities\Admin;
use Modules\Branches\Entities\Branch;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Admin::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Branch::class)->constrained()->cascadeOnDelete();
        });
    }
};
