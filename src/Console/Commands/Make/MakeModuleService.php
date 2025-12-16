<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleService extends GeneratorCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-service';

    protected $description = 'Create a new service class inside a Module';

    protected $type = 'Service';

    protected function getStub(): string
    {
        return dirname(__DIR__, 4).'/src/Stubs/services/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Services';
    }

    protected function buildClass($name): string
    {
        $stub = File::get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }
}
