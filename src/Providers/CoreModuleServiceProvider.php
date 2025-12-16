<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Providers;

use Illuminate\Support\ServiceProvider;

class CoreModuleServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->registerCommands();
    }

    protected function registerCommands(): void
    {
        $this->commands([
            \Victormgomes\LaravelModules\Console\Commands\ModuleInit::class,
            \Victormgomes\LaravelModules\Console\Commands\ModuleAvailable::class,
            \Victormgomes\LaravelModules\Console\Commands\ModuleUnavailable::class,
            \Victormgomes\LaravelModules\Console\Commands\ModuleEnable::class,
            \Victormgomes\LaravelModules\Console\Commands\ModuleDisable::class,
            \Victormgomes\LaravelModules\Console\Commands\ModuleAdd::class,
            \Victormgomes\LaravelModules\Console\Commands\ModuleRemove::class,
            \Victormgomes\LaravelModules\Console\Commands\ModulePrune::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleCast::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleChannel::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleCommand::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleComponent::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleController::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleEnum::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleEvent::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleException::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleFactory::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleJob::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleListener::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleMail::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleMiddleware::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleMigration::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleModel::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleNotification::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleObserver::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModulePolicy::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleProvider::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleRequest::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleResource::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleRule::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleScope::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleSeeder::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleTest::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleView::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleServiceProvider::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleRoutes::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleLang::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleService::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleTrait::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleInterface::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleDto::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleConfig::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleClass::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleLivewire::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleApiRoutes::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleWebRoutes::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleChannelRoutes::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleConsoleRoutes::class,
            \Victormgomes\LaravelModules\Console\Commands\Make\MakeModuleAssets::class,
        ]);
    }
}
