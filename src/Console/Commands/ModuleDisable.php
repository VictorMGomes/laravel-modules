<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Victormgomes\LaravelModules\Support\EnvModuleManager;

class ModuleDisable extends Command
{
    protected $signature = 'module:disable {module}';

    protected $description = 'Remove module from APP_MODULES_ENABLED in .env';

    public function handle(EnvModuleManager $envManager): int
    {
        $module = $this->argument('module');

        if (! $envManager->isEnabled($module)) {
            $this->warn("Module [{$module}] is not currently enabled.");

            return 0;
        }

        if ($envManager->disable($module)) {
            $this->components->info("Module [{$module}] disabled.");

            return 0;
        }

        $this->error('Failed to disable module in .env file.');

        return 1;
    }
}
