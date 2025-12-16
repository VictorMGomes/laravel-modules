<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\RuleMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleRule extends RuleMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-rule';

    protected $description = 'Create a new validation rule inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Rules';
    }
}
