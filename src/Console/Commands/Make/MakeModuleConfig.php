<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ConfigMakeCommand;
use Illuminate\Support\Str;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleConfig extends ConfigMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-config';

    protected $description = 'Create a new configuration file inside a Module';

    protected function getPath($name): string
    {
        $moduleDef = $this->getModuleDefinition();
        $fileName = $this->argument('name');

        return $moduleDef->path.'/Config/'.Str::finish($fileName, '.php');
    }
}
