<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Database\Console\Seeds\SeederMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleSeeder extends SeederMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-seeder';

    protected $description = 'Create a new seeder class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Database\Seeders';
    }
}
