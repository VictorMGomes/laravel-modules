<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Support;

use Illuminate\Support\Facades\File;

class ModuleConfigRegistry
{
    protected string $configPath;

    public function __construct()
    {
        $this->configPath = config_path('modules.php');
    }

    public function register(ModuleDefinition $module): bool
    {
        if (! File::exists($this->configPath)) {
            return false;
        }

        $content = File::get($this->configPath);

        if (str_contains($content, $module->providerClass)) {
            return true;
        }

        $pattern = "/('modules_available'\s*=>\s*\[)/";
        $replacement = "$1\n        {$module->providerClass},";

        $newContent = preg_replace($pattern, $replacement, $content);

        return $newContent && File::put($this->configPath, $newContent) !== false;
    }

    public function unregister(ModuleDefinition $module): bool
    {
        if (! File::exists($this->configPath)) {
            return false;
        }

        $content = File::get($this->configPath);

        if (! str_contains($content, $module->providerClass)) {
            return true;
        }

        $content = str_replace(["        {$module->providerClass},\n", "        {$module->providerClass}"], '', $content);

        return (bool) File::put($this->configPath, $content);
    }

    public function isRegistered(ModuleDefinition $module): bool
    {
        if (! File::exists($this->configPath)) {
            return false;
        }

        return str_contains(File::get($this->configPath), $module->providerClass);
    }
}
