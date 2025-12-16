<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleCommand extends ConsoleMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-command';

    protected $description = 'Create a new Artisan command inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Console\Commands';
    }
}
