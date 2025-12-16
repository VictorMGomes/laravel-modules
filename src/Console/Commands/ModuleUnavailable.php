<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Victormgomes\LaravelModules\Support\ModuleConfigRegistry;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class ModuleUnavailable extends Command
{
    protected $signature = 'module:unavailable {module}';

    protected $description = 'Remove module provider from config/modules.php';

    public function handle(ModuleConfigRegistry $registry): int
    {
        $moduleDef = new ModuleDefinition($this->argument('module'));

        if (! $registry->isRegistered($moduleDef)) {
            $this->warn("Module [{$moduleDef->studlyName}] is not present in config.");

            return 0;
        }

        if ($registry->unregister($moduleDef)) {
            $this->components->info("Module [{$moduleDef->studlyName}] removed from available list.");

            return 0;
        }

        $this->error('Failed to unregister module from config.');

        return 1;
    }
}
