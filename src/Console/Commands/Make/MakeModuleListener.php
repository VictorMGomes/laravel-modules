<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ListenerMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleListener extends ListenerMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-listener';

    protected $description = 'Create a new listener class inside a Module';
}
