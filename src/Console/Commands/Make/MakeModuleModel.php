<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleModel extends ModelMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-model';

    protected $description = 'Create a new Eloquent model class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Models';
    }
}
