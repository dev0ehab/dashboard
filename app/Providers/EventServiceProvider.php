<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Accounts\Events\ChangePasswordEvent;
use Modules\Accounts\Events\CreateAuthModelEvent;
use Modules\Accounts\Events\ResetPasswordEvent;
use Modules\Accounts\Events\VerificationEvent;
use Modules\Accounts\Listeners\ChangePasswordListener;
use Modules\Accounts\Listeners\CreateAuthModelListener;
use Modules\Accounts\Listeners\ResetPasswordListener;
use Modules\Accounts\Listeners\VerificationListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        ChangePasswordEvent::class => [
            ChangePasswordListener::class
        ],

        ResetPasswordEvent::class => [
            ResetPasswordListener::class
        ],

        VerificationEvent::class => [
            VerificationListener::class
        ],

        CreateAuthModelEvent::class => [
            CreateAuthModelListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
