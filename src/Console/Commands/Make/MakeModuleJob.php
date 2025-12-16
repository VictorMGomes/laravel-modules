<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\JobMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleJob extends JobMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-job';

    protected $description = 'Create a new job class inside a Module';
}
