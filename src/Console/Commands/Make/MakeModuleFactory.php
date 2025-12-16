<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Database\Console\Factories\FactoryMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleFactory extends FactoryMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-factory';

    protected $description = 'Create a new model factory inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Database\Factories';
    }

    protected function getNamespace($name)
    {
        return $this->getModuleDefinition()->namespace.'\\Database\\Factories';
    }

    protected function guessModelName($name): string
    {
        $moduleNamespace = $this->getModuleDefinition()->namespace;

        if (str_ends_with($name, 'Factory')) {
            $name = substr($name, 0, -7);
        }

        $modelName = class_basename($name);

        return "{$moduleNamespace}\\Models\\{$modelName}";
    }
}
