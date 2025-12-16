<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(CoreModuleServiceProvider::class);
        $this->app->register(BootModulesServiceProvider::class);
    }

    public function boot(): void {}
}
