<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleServiceProvider extends GeneratorCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-service-provider';

    protected $description = 'Create a new service provider inside a Module with BaseModule extension';

    protected $type = 'Service Provider';

    protected function getStub(): string
    {
        return dirname(__DIR__, 4).'/src/Stubs/providers/module-service-provider.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Providers';
    }

    protected function buildClass($name): string
    {
        $stub = File::get($this->getStub());

        $moduleName = $this->getModuleDefinition()->studlyName;

        $stub = str_replace('{{ moduleName }}', $moduleName, $stub);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }
}
