<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;

class ModulePrune extends Command
{
    protected $signature = 'module:prune {module? : The name of the module} {--force : Force the operation without confirmation}';

    protected $description = 'Delete a module permanently (files and registry)';

    public function handle(): int
    {
        $module = $this->argument('module');

        if (! $module) {
            $path = base_path('modules');

            if (! File::isDirectory($path)) {
                $this->error('No modules directory found.');

                return 1;
            }

            $availableModules = collect(File::directories($path))
                ->map(fn ($dir) => basename($dir))
                ->values()
                ->toArray();

            if (empty($availableModules)) {
                $this->error('No modules found to prune.');

                return 1;
            }

            $module = select(
                label: 'Which module do you want to prune?',
                options: $availableModules,
                scroll: 10,
                hint: 'Use arrow keys to navigate and Enter to select.'
            );
        }

        $module = Str::studly($module);
        $modulePath = base_path("modules/{$module}");

        if (! File::isDirectory($modulePath)) {
            $this->error("Module [{$module}] not found at {$modulePath}.");

            return 1;
        }

        if (! $this->option('force')) {
            $confirmed = confirm(
                label: "Are you sure you want to PERMANENTLY DELETE [{$module}]?",
                default: false,
                yes: 'Yes, delete it permanently',
                no: 'No, cancel operation',
                hint: 'This action cannot be undone.'
            );

            if (! $confirmed) {
                $this->info('Operation cancelled.');

                return 0;
            }
        }

        $this->alert("Pruning Module: {$module}");

        $this->info('Removing from registry...');
        $exitCode = $this->call('module:remove', ['module' => $module]);

        if ($exitCode !== 0) {
            $this->error('Failed to unregister module. Aborting file deletion.');

            return 1;
        }

        $this->warn("Deleting files from {$modulePath}...");

        if (File::deleteDirectory($modulePath)) {
            $this->components->info('Directory deleted successfully.');
        } else {
            $this->error('Failed to delete directory.');

            return 1;
        }

        $this->newLine();
        $this->info("Module [{$module}] pruned successfully!");

        return 0;
    }
}
