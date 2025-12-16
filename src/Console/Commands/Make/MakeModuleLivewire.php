<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Features\SupportConsoleCommands\Commands\ComponentParser;
use Livewire\Features\SupportConsoleCommands\Commands\MakeCommand as LivewireMakeCommand;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class MakeModuleLivewire extends LivewireMakeCommand
{
    protected $signature = 'module:make-livewire
                            {module : The name of the module}
                            {name : The name of the component}
                            {--force : Force the creation of the component}
                            {--inline : Create an inline component}
                            {--test : Create a test file for the component}
                            {--pest : Create a Pest test file for the component}
                            {--stub= : If you have several stubs, stored in subfolders}';

    protected $description = 'Create a new Livewire component inside a Module';

    protected ModuleDefinition $moduleDef;

    public function handle()
    {
        $this->moduleDef = new ModuleDefinition($this->argument('module'));

        $namespace = "{$this->moduleDef->namespace}\\Livewire";
        $viewPath = "{$this->moduleDef->path}/Resources/views/livewire";

        File::ensureDirectoryExists($viewPath);

        Config::set('livewire.class_namespace', $namespace);
        Config::set('livewire.view_path', $viewPath);

        $this->parser = new ComponentParser(
            $namespace,
            $viewPath,
            $this->argument('name'),
            $this->option('stub')
        );

        if (! $this->isClassNameValid($name = $this->parser->className())) {
            $this->error("Class is invalid: {$name}");

            return;
        }

        $force = $this->option('force');
        $inline = $this->option('inline');

        $classPath = $this->createClass($force, $inline);

        if ($classPath) {
            $this->info("Livewire component created in module [{$this->moduleDef->studlyName}]");
        }
    }

    protected function createClass($force = false, $inline = false)
    {
        $componentName = $this->argument('name');

        $componentName = str_replace(['.', '\\'], '/', $componentName);
        $componentName = collect(explode('/', $componentName))
            ->map(fn ($part) => Str::studly($part))
            ->implode('/');

        $classPath = "{$this->moduleDef->path}/Livewire/{$componentName}.php";

        if (File::exists($classPath) && ! $force) {
            $this->error("Class already exists: {$classPath}");

            return false;
        }

        $this->ensureDirectoryExists($classPath);
        File::put($classPath, $this->parser->classContents($inline));

        return $classPath;
    }
}
