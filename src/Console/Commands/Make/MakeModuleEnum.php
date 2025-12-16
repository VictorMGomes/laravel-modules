<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\EnumMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleEnum extends EnumMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-enum';

    protected $description = 'Create a new enum inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Enums';
    }
}
