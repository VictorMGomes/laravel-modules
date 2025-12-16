<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\TraitMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleTrait extends TraitMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-trait';

    protected $description = 'Create a new trait inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Traits';
    }
}
