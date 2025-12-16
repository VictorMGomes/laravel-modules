<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ProviderMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleProvider extends ProviderMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-provider';

    protected $description = 'Create a new service provider inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Providers';
    }
}
