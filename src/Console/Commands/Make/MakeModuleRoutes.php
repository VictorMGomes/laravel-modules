<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RuntimeException;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class MakeModuleRoutes extends Command
{
    protected $signature = 'module:make-routes {module : The name of the module}';

    protected $description = 'Create web, api, console and channel route files for a Module using Stubs';

    public function handle(): int
    {
        $moduleDef = new ModuleDefinition($this->argument('module'));
        $moduleKebab = Str::kebab($moduleDef->studlyName);

        $path = "{$moduleDef->path}/Routes";

        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $replacements = [
            'module' => $moduleDef->studlyName,
            'module_kebab' => $moduleKebab,
        ];

        $routeTypes = ['web', 'api', 'console', 'channels'];
        $hasErrors = false;

        foreach ($routeTypes as $type) {
            try {
                $content = $this->getStubContents($type, $replacements);
                $this->createFile("{$path}/{$type}.php", $content, $type);
            } catch (RuntimeException $e) {
                $this->components->warn("Skipping [{$type}]: ".$e->getMessage());
                $hasErrors = true;
            }
        }

        return $hasErrors ? 1 : 0;
    }

    protected function getStubContents(string $type, array $replacements): string
    {
        $stubPath = dirname(__DIR__, 4)."/src/Stubs/routes/{$type}.stub";

        if (! File::exists($stubPath)) {
            throw new RuntimeException("Stub file not found at: {$stubPath}");
        }

        $content = File::get($stubPath);

        foreach ($replacements as $key => $value) {
            $content = str_replace("{{ $key }}", $value, $content);
        }

        return $content;
    }

    protected function createFile(string $path, string $content, string $type): void
    {
        if (! File::exists($path)) {
            File::put($path, $content);
            $this->components->info("Routes-{$type} created successfully.");
        } else {
            $this->components->warn("Routes-{$type} already exists.");
        }
    }
}
