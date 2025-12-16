<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleController extends ControllerMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-controller';

    protected $description = 'Create a new controller class inside a Module';

    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);
        $moduleNamespace = $this->rootNamespace();

        $stub = str_replace("use {$moduleNamespace}\\Http\\Controllers\\Controller;\n", '', $stub);

        if (! str_contains($stub, 'use App\Http\Controllers\Controller;')) {
            $stub = str_replace(
                "use Illuminate\Http\Request;",
                "use App\Http\Controllers\Controller;\nuse Illuminate\Http\Request;",
                $stub
            );
        }

        if (! str_contains($stub, 'extends Controller')) {
            $className = class_basename($this->argument('name'));
            $stub = str_replace("class {$className}", "class {$className} extends Controller", $stub);
        }

        return $stub;
    }
}
