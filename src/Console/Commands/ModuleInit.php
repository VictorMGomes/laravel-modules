<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Throwable;
use Victormgomes\LaravelModules\Support\ModuleDefinition;
use Victormgomes\LaravelModules\Traits\RunSafeCommands;

use function Laravel\Prompts\select;

class ModuleInit extends Command
{
    use RunSafeCommands;

    protected $signature = 'module:init
                            {module : The name of the module}
                            {--type= : The scaffold type (minimal, basic, complete)}';

    protected $description = 'Scaffold a module structure with selectable complexity (transactional)';

    public function handle(): int
    {
        $moduleDef = new ModuleDefinition($this->argument('module'));
        $name = $moduleDef->studlyName;

        $type = $this->option('type');

        if (! $type) {
            $type = select(
                label: 'Select the scaffold complexity:',
                options: [
                    'minimal' => 'Minimal (Provider, Config, Routes only)',
                    'basic' => 'Basic (Flow: Model, Status Controller, Health Service, DTO, Tests)',
                    'complete' => 'Complete (Full Suite: Events, Jobs, Policies, Views, etc.)',
                ],
                default: 'basic'
            );
        }

        if (! in_array($type, ['minimal', 'basic', 'complete'])) {
            $this->error('Invalid type. Available options: minimal, basic, complete.');

            return 1;
        }

        if ($moduleDef->exists()) {
            $this->error("Module [{$name}] already exists at {$moduleDef->path}.");

            return 1;
        }

        $this->alert("Initializing Module: {$name} [Type: {$type}]");

        try {
            $this->info('--- Infrastructure Layer (Core) ---');

            $this->runSafe('module:make-config', ['module' => $name, 'name' => strtolower($name)]);
            $this->runSafe('module:make-service-provider', ['module' => $name, 'name' => "{$name}ModuleServiceProvider"]);

            $this->runSafe('module:make-web-routes', ['module' => $name]);
            $this->runSafe('module:make-api-routes', ['module' => $name]);
            $this->runSafe('module:make-console-routes', ['module' => $name]);

            if ($type === 'minimal') {
                goto registration;
            }

            $this->info("\n--- Database Layer ---");
            $this->runSafe('module:make-model', ['module' => $name, 'name' => $name]);
            $this->runSafe('module:make-factory', ['module' => $name, 'name' => "{$name}Factory"]);
            $this->runSafe('module:make-seeder', ['module' => $name, 'name' => "{$name}DatabaseSeeder"]);

            $tableName = Str::snake(Str::plural($name));
            $this->runSafe('module:make-migration', [
                'module' => $name,
                'name' => "create_{$tableName}_table",
                '--create' => $tableName,
            ]);

            if ($type === 'complete') {
                $this->runSafe('module:make-scope', ['module' => $name, 'name' => "Active{$name}Scope"]);
                $this->runSafe('module:make-cast', ['module' => $name, 'name' => "{$name}SettingsCast"]);
            }

            $modelPath = "{$moduleDef->path}/Models/{$name}.php";
            if (File::exists($modelPath)) {
                require_once $modelPath;
            }
            $modelNamespace = "{$moduleDef->namespace}\\Models\\{$name}";

            $this->info("\n--- Business Logic Layer ---");
            $this->runSafe('module:make-service', ['module' => $name, 'name' => "{$name}HealthService"]);
            $this->runSafe('module:make-exception', ['module' => $name, 'name' => "{$name}DomainException"]);
            $this->runSafe('module:make-dto', ['module' => $name, 'name' => "{$name}HealthDTO"]);
            $this->runSafe('module:make-interface', ['module' => $name, 'name' => "{$name}ServiceInterface"]);

            if ($type === 'complete') {
                $this->runSafe('module:make-trait', ['module' => $name, 'name' => "Manages{$name}State"]);
                $this->runSafe('module:make-enum', ['module' => $name, 'name' => "{$name}StatusEnum"]);
                $this->runSafe('module:make-rule', ['module' => $name, 'name' => "Valid{$name}Configuration"]);
            }

            $this->info("\n--- HTTP Presentation Layer ---");
            $this->runSafe('module:make-controller', [
                'module' => $name,
                'name' => "{$name}StatusController",
                '--api' => true,
                '--model' => $modelNamespace,
            ]);
            $this->runSafe('module:make-request', ['module' => $name, 'name' => "Check{$name}StatusRequest"]);
            $this->runSafe('module:make-resource', ['module' => $name, 'name' => "{$name}StatusResource"]);

            if ($type === 'complete') {
                $this->runSafe('module:make-middleware', ['module' => $name, 'name' => "Ensure{$name}IsEnabled"]);
            }

            if ($type === 'complete') {
                $this->info("\n--- Events & Async Layer ---");
                $this->runSafe('module:make-event', ['module' => $name, 'name' => "{$name}StatusChecked"]);
                $this->runSafe('module:make-listener', ['module' => $name, 'name' => "Log{$name}Health"]);
                $this->runSafe('module:make-job', ['module' => $name, 'name' => "Run{$name}Diagnostics"]);
                $this->runSafe('module:make-observer', ['module' => $name, 'name' => "{$name}AuditObserver"]);
                $this->runSafe('module:make-mail', ['module' => $name, 'name' => "{$name}HealthReportMail"]);
                $this->runSafe('module:make-notification', ['module' => $name, 'name' => "{$name}AlertNotification"]);
                $this->runSafe('module:make-command', ['module' => $name, 'name' => "Check{$name}Status"]);
                $this->runSafe('module:make-channel', ['module' => $name, 'name' => "{$name}UpdatesChannel"]);
                $this->runSafe('module:make-channel-routes', ['module' => $name]);
            }

            if ($type === 'complete') {
                $this->info("\n--- Security Layer ---");
                $this->runSafe('module:make-policy', [
                    'module' => $name,
                    'name' => "{$name}AccessPolicy",
                    '--model' => $modelNamespace,
                ]);
            }

            if ($type === 'complete') {
                $this->info("\n--- Frontend & Localization ---");

                $this->runSafe('module:make-lang', ['module' => $name]);

                $this->runSafe('module:make-assets', ['module' => $name]);

                if ($this->hasCommand('module:make-view')) {
                    $this->runSafe('module:make-view', ['module' => $name, 'name' => 'status-dashboard']);
                }

                $this->runSafe('module:make-component', ['module' => $name, 'name' => "{$name}StatusBadge"]);
            }

            $this->info("\n--- Tests ---");
            $this->runSafe('module:make-test', ['module' => $name, 'name' => "{$name}HealthCheckTest"]);

            registration:

            $this->info("\n--- Activation ---");
            $this->runSafe('module:add', ['module' => $name]);

            $this->newLine();
            $this->info("✅ Module {$name} created successfully! [Type: {$type}]");

            return 0;

        } catch (Throwable $e) {
            $this->newLine();
            $this->error('Failed: '.$e->getMessage());
            $this->warn("Rolling back changes... Deleting directory: {$moduleDef->path}");
            if (File::isDirectory($moduleDef->path)) {
                File::deleteDirectory($moduleDef->path);
            }
            $this->error('Aborted. No files were kept.');

            return 1;
        }
    }
}
