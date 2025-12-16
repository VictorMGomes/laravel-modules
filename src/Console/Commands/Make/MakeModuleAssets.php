<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class MakeModuleAssets extends Command
{
    protected $signature = 'module:make-assets {module : The name of the module}';

    protected $description = 'Create basic asset structure (js/css) for a Module';

    public function handle(): int
    {
        $moduleDef = new ModuleDefinition($this->argument('module'));
        $assetsPath = "{$moduleDef->path}/Resources/assets";

        if (! File::isDirectory($assetsPath)) {
            File::makeDirectory($assetsPath, 0755, true);
        }

        $this->createAsset(
            $assetsPath,
            'js',
            'app.js',
            "console.log('Module {$moduleDef->studlyName} loaded.');"
        );

        $this->createAsset(
            $assetsPath,
            'css',
            'app.css',
            "/* Module {$moduleDef->studlyName} styles */\n.module-wrapper {\n    padding: 20px;\n}"
        );

        return 0;
    }

    protected function createAsset(string $basePath, string $type, string $fileName, string $content): void
    {
        $dir = "{$basePath}/{$type}";

        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filePath = "{$dir}/{$fileName}";

        if (! File::exists($filePath)) {
            File::put($filePath, $content);
            $this->components->info("Asset created -> {$type}/{$fileName}");
        } else {
            $this->components->warn("Asset already exists -> {$type}/{$fileName}");
        }
    }
}
