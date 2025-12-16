<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ModuleRemove extends Command
{
    protected $signature = 'module:remove {module : The name of the module}';

    protected $description = 'Remove module from config modules_available and disable it in .env';

    public function handle(): int
    {
        $module = Str::studly($this->argument('module'));

        $this->info("Removing module [{$module}] from registry...");

        $this->call('module:disable', [
            'module' => $module,
        ]);

        $this->call('module:unavailable', [
            'module' => $module,
        ]);

        $this->components->info("Module [{$module}] removed from registry and disabled.");

        return 0;
    }
}
