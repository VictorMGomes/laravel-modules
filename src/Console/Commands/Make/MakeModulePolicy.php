<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\PolicyMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModulePolicy extends PolicyMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-policy';

    protected $description = 'Create a new policy class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Policies';
    }
}
