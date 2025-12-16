<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Throwable;
use Victormgomes\LaravelModules\Support\ClassInspector;
use Victormgomes\LaravelModules\Support\EnvModuleManager;

class BootModulesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $availableProviders = config('modules.modules_available', []);

        $envManager = new EnvModuleManager;

        foreach ($availableProviders as $providerClass) {
            try {
                $moduleName = ClassInspector::getModuleNameFromProvider($providerClass);

                if (! $moduleName) {
                    Log::warning("Não foi possível determinar o módulo para o provider: {$providerClass}");

                    continue;
                }

                if (! $envManager->isEnabled($moduleName)) {
                    continue;
                }

                $this->app->register($providerClass);

            } catch (Throwable $e) {
                Log::error("Erro ao carregar provider do módulo '{$providerClass}'", [
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    public function boot(): void {}
}
