<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\TestMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleTest extends TestMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-test';

    protected $description = 'Create a new test class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Tests';
    }
}
