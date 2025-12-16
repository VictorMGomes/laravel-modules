<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ComponentMakeCommand;
use Illuminate\Support\Str;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleComponent extends ComponentMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-component';

    protected $description = 'Create a new view component class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\View\Components';
    }

    protected function viewPath($path = '')
    {
        $moduleDef = $this->getModuleDefinition();
        $viewsPath = $moduleDef->path.'/Resources/views';

        if (str_contains($path, '::')) {
            $path = explode('::', $path)[1];
        }

        return $viewsPath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    protected function getView()
    {
        $view = parent::getView();
        $moduleKebab = Str::kebab($this->getModuleDefinition()->studlyName);

        return "{$moduleKebab}::{$view}";
    }
}
