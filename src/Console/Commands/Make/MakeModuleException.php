<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ExceptionMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleException extends ExceptionMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-exception';

    protected $description = 'Create a new custom exception class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Exceptions';
    }
}
