<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\EventMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleEvent extends EventMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-event';

    protected $description = 'Create a new event class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Events';
    }
}
