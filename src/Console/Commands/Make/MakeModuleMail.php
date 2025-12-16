<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Console\Commands\Make;

use Illuminate\Foundation\Console\MailMakeCommand;
use Victormgomes\LaravelModules\Traits\ModuleGeneratorTrait;

class MakeModuleMail extends MailMakeCommand
{
    use ModuleGeneratorTrait;

    protected $name = 'module:make-mail';

    protected $description = 'Create a new email class inside a Module';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Mail';
    }
}
