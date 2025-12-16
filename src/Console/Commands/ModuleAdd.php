<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ModuleAdd extends Command
{
    protected $signature = 'module:add {module : The name of the module}';

    protected $description = 'Add module to config modules_available and enable it in .env';

    public function handle(): int
    {
        $module = Str::studly($this->argument('module'));

        $this->info("Adding module [{$module}]...");

        $resultAvailable = $this->call('module:available', [
            'module' => $module,
        ]);

        $resultEnable = $this->call('module:enable', [
            'module' => $module,
        ]);

        if ($resultAvailable !== 0 || $resultEnable !== 0) {
            $this->error("Failed to fully add module [{$module}]. Check previous errors.");

            return 1;
        }

        $this->components->info("Module [{$module}] added and enabled successfully.");

        return 0;
    }
}
