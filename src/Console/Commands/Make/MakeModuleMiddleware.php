<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleMiddleware extends MiddlewareMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-middleware';

    protected $description = 'Create a new middleware class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Http\Middleware';
    }
}
