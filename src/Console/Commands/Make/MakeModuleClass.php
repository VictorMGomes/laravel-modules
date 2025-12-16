<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ClassMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleClass extends ClassMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-class';

    protected $description = 'Create a new class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Classes';
    }
}
