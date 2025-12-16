<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class MakeModuleLang extends Command
{
    protected $signature = 'module:make-lang {module} {--lang=en}';

    protected $description = 'Create a default language file for a Module';

    public function handle(): int
    {
        $moduleDef = new ModuleDefinition($this->argument('module'));
        $lang = $this->option('lang');
        $moduleKebab = Str::kebab($moduleDef->studlyName);

        $directory = "{$moduleDef->path}/Resources/lang/{$lang}";

        File::ensureDirectoryExists($directory);

        $filePath = "{$directory}/{$moduleKebab}.php";

        if (File::exists($filePath)) {
            $this->components->warn("Lang file [{$lang}/{$moduleKebab}.php] already exists.");

            return 1;
        }

        $stubPath = dirname(__DIR__, 4).'/src/Stubs/translations/lang.stub';

        if (! File::exists($stubPath)) {
            $this->error("Stub file not found at: {$stubPath}");

            return 1;
        }

        $content = File::get($stubPath);
        $content = str_replace('{{ module }}', $moduleDef->studlyName, $content);

        File::put($filePath, $content);

        $this->components->info("Lang file [{$lang}/{$moduleKebab}.php] created successfully.");

        return 0;
    }
}
