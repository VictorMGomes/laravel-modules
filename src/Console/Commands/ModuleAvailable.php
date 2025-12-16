<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Victormgomes\LaravelModules\Support\ModuleConfigRegistry;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class ModuleAvailable extends Command
{
    protected $signature = 'module:available {module}';

    protected $description = 'Register module provider in config/modules.php';

    public function handle(ModuleConfigRegistry $registry): int
    {
        $moduleDef = new ModuleDefinition($this->argument('module'));

        if ($registry->isRegistered($moduleDef)) {
            $this->warn("Module [{$moduleDef->studlyName}] is already available in config.");

            return 0;
        }

        if ($registry->register($moduleDef)) {
            $this->components->info("Module [{$moduleDef->studlyName}] added to available list.");

            return 0;
        }

        $this->error('Failed to register module in config.');

        return 1;
    }
}
