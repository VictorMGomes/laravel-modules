<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class MakeModuleView extends Command
{
    protected $signature = 'module:make-view {module} {name} {--extension=blade.php}';

    protected $description = 'Create a new view file inside a Module';

    public function handle(): int
    {
        $moduleDef = new ModuleDefinition($this->argument('module'));
        $name = str_replace('.', '/', $this->argument('name'));
        $extension = $this->option('extension');

        $viewPath = "{$moduleDef->path}/Resources/views";

        File::ensureDirectoryExists($viewPath);

        $filePath = "{$viewPath}/{$name}.{$extension}";
        $directory = dirname($filePath);

        File::ensureDirectoryExists($directory);

        if (File::exists($filePath)) {
            $this->error("View already exists at {$filePath}");

            return 1;
        }

        File::put($filePath, "<div>\n    \n</div>");

        $this->components->info("View created -> {$filePath}");

        return 0;
    }
}
