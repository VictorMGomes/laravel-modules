<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleDto extends GeneratorCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-dto';

    protected $description = 'Create a new DTO inside a Module';

    protected $type = 'DTO';

    protected function getStub(): string
    {
        return dirname(__DIR__, 4).'/src/Stubs/dtos/dto.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\DTOs';
    }

    protected function buildClass($name): string
    {
        $stub = File::get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }
}
