<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ResourceMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleResource extends ResourceMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-resource';

    protected $description = 'Create a new resource class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Http\Resources';
    }
}
