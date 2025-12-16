<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Victormgomes\LaravelModules\Support\EnvModuleManager;

class ModuleEnable extends Command
{
    protected $signature = 'module:enable {module}';

    protected $description = 'Add module to APP_MODULES_ENABLED in .env';

    public function handle(EnvModuleManager $envManager): int
    {
        $module = $this->argument('module');

        if ($envManager->isEnabled($module)) {
            $this->warn("Module [{$module}] is already enabled.");

            return 0;
        }

        if ($envManager->enable($module)) {
            $this->components->info("Module [{$module}] enabled.");

            return 0;
        }

        $this->error('Failed to enable module in .env file.');

        return 1;
    }
}
