<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\NotificationMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleNotification extends NotificationMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-notification';

    protected $description = 'Create a new notification class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Notifications';
    }
}
