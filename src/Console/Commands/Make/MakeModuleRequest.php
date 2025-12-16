<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\RequestMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleRequest extends RequestMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-request';

    protected $description = 'Create a new form request class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Http\Requests';
    }
}
