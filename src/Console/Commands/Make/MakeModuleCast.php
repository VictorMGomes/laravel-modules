<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\CastMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleCast extends CastMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-cast';

    protected $description = 'Create a new custom Eloquent cast class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Casts';
    }
}
