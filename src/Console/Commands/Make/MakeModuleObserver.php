<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ObserverMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleObserver extends ObserverMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-observer';

    protected $description = 'Create a new observer class inside a Module';
}
