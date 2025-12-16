<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\ChannelMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleChannel extends ChannelMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-channel';

    protected $description = 'Create a new channel class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Broadcasting';
    }
}
