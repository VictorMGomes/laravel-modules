<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ScopeMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleScope extends ScopeMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-scope';

    protected $description = 'Create a new scope class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Models\Scopes';
    }
}
