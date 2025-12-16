<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class MakeModuleChannelRoutes extends Command
{
    protected $signature = 'module:make-channel-routes {module : The name of the module}';

    protected $description = 'Create channels routes file for a Module';

    public function handle(): int
    {
        return $this->generateRouteFile('channels');
    }

    protected function generateRouteFile(string $type): int
    {
        $moduleDef = new ModuleDefinition($this->argument('module'));
        $path = "{$moduleDef->path}/Routes";

        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $filePath = "{$path}/{$type}.php";

        if (File::exists($filePath)) {
            $this->components->warn("Routes-{$type} already exists.");

            return 0;
        }

        $stubPath = dirname(__DIR__, 4)."/src/Stubs/routes/{$type}.stub";

        if (! File::exists($stubPath)) {
            $this->error("Stub not found: {$stubPath}");

            return 1;
        }

        $content = File::get($stubPath);
        $content = str_replace(
            ['{{ module }}', '{{ module_kebab }}'],
            [$moduleDef->studlyName, Str::kebab($moduleDef->studlyName)],
            $content
        );

        File::put($filePath, $content);
        $this->components->info("Routes-{$type} created successfully.");

        return 0;
    }
}
