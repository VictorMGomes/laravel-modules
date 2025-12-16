<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Support;

use Illuminate\Support\Facades\File;

class EnvModuleManager
{
    protected string $envPath;

    public function __construct()
    {
        $this->envPath = base_path('.env');
    }

    public function enable(string $moduleName): bool
    {
        return $this->updateEnv($moduleName, 'add');
    }

    public function disable(string $moduleName): bool
    {
        return $this->updateEnv($moduleName, 'remove');
    }

    public function isEnabled(string $moduleName): bool
    {
        $modules = $this->getModules();

        return in_array($moduleName, $modules);
    }

    protected function getModules(): array
    {
        if (! File::exists($this->envPath)) {
            return [];
        }

        $content = File::get($this->envPath);
        if (preg_match('/^APP_MODULES_ENABLED=(.*)$/m', $content, $matches)) {
            $value = trim($matches[1]);

            return $value ? array_map('trim', explode(',', $value)) : [];
        }

        return [];
    }

    protected function updateEnv(string $module, string $action): bool
    {
        if (! File::exists($this->envPath)) {
            return false;
        }

        $modules = $this->getModules();
        $exists = in_array($module, $modules);

        if ($action === 'add' && $exists) {
            return true;
        }
        if ($action === 'remove' && ! $exists) {
            return true;
        }

        if ($action === 'add') {
            $modules[] = $module;
        } else {
            $modules = array_filter($modules, fn ($m) => $m !== $module);
        }

        $newValue = implode(',', $modules);
        $content = File::get($this->envPath);
        $pattern = '/^APP_MODULES_ENABLED=(.*)$/m';

        if (preg_match($pattern, $content)) {
            $newContent = preg_replace($pattern, "APP_MODULES_ENABLED={$newValue}", $content);
        } else {
            $newContent = $content."\nAPP_MODULES_ENABLED={$newValue}";
        }

        return (bool) File::put($this->envPath, $newContent);
    }
}
