<?php

namespace App\Providers;

use File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->registerModuleProviders();
    }

    protected function registerModuleProviders()
    {
        // Define the path to your modules directory
        $modulesPath = base_path('Modules');

        // Scan for modules if the directory exists
        if (File::exists($modulesPath)) {
            $modules = File::directories($modulesPath);

            // Loop through each module and load its service provider
            foreach ($modules as $modulePath) {
                $moduleName = basename($modulePath);
                $serviceProvider = "Modules\\$moduleName\\Providers\\{$moduleName}ServiceProvider";

                // Check if the Service Provider class exists and register it
                if (class_exists($serviceProvider)) {
                    $this->app->register($serviceProvider);
                }
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
