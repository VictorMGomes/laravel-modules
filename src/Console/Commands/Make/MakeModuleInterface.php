<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\InterfaceMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleInterface extends InterfaceMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-interface';

    protected $description = 'Create a new interface inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Contracts';
    }
}
