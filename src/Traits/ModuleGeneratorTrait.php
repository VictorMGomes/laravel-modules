<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Traits;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

trait ModuleGeneratorTrait
{
    protected function getModuleDefinition(): ModuleDefinition
    {
        return new ModuleDefinition($this->argument('module'));
    }

    protected function getArguments(): array
    {
        $arguments = parent::getArguments();

        array_unshift($arguments, ['module', InputArgument::REQUIRED, 'The name of the module']);

        return $arguments;
    }

    protected function rootNamespace(): string
    {
        return $this->getModuleDefinition()->namespace;
    }

    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->getModuleDefinition()->path.'/'.str_replace('\\', '/', trim($name, '\\')).'.php';
    }
}
