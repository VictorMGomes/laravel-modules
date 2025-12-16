<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Victormgomes\LaravelModules\Support\ModuleDefinition;

class MakeModuleMigration extends MigrateMakeCommand
{
    protected $signature = 'module:make-migration
                            {module : The module name}
                            {name : The name of the migration}
                            {--create= : The table to be created}
                            {--table= : The table to be migrated}
                            {--path= : The location where the migration file should be created}
                            {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
                            {--fullpath : Output the full path of the migration}';

    protected $description = 'Create a new migration file inside a Module';

    public function __construct()
    {
        parent::__construct(app('migration.creator'), app(Composer::class));
    }

    public function handle(): void
    {
        if (! $this->option('path')) {
            $moduleDef = new ModuleDefinition($this->argument('module'));

            $relativePath = "modules/{$moduleDef->studlyName}/Database/Migrations";

            $absolutePath = base_path($relativePath);

            if (! File::exists($absolutePath)) {
                File::makeDirectory($absolutePath, 0755, true);
            }

            $this->input->setOption('path', $relativePath);
        }

        parent::handle();
    }
}
