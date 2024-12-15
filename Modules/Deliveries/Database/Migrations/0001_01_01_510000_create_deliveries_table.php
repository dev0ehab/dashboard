<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Deliveries\Entities\Shift;
use Modules\Deliveries\Entities\Zone;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(Zone::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Shift::class)->constrained()->cascadeOnDelete();

            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();

            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('dial_code')->nullable();

            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password')->nullable();

            $table->timestamp('blocked_at')->nullable();

            $table->string('preferred_locale')->nullable();
            $table->datetime('last_login_at')->nullable();

            $table->string('device_token')->nullable();

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};
