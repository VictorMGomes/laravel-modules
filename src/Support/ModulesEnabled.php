<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Support;

class ModulesEnabled
{
    public static function getList(): array
    {
        $enabledModules = config('modules.modules_enabled', '');

        if (is_array($enabledModules)) {
            return array_filter($enabledModules);
        }

        return array_filter(array_map('trim', explode(',', (string) $enabledModules)));
    }

    public static function getSeeders(): array
    {
        $modules = self::getList();
        $seeders = [];

        foreach ($modules as $moduleName) {
            $moduleDef = new ModuleDefinition($moduleName);

            $className = "{$moduleDef->namespace}\\Database\\Seeders\\{$moduleDef->studlyName}DatabaseSeeder";

            if (class_exists($className)) {
                $seeders[] = $className;
            }
        }

        return $seeders;
    }

    public static function getMigrations(): array
    {
        $migrations = [];

        $modules = self::getList();

        foreach ($modules as $moduleName) {
            $moduleDef = new ModuleDefinition($moduleName);

            $migrationPath = "{$moduleDef->path}/Database/Migrations";

            if (is_dir($migrationPath)) {
                $files = glob($migrationPath.'/*.php') ?: [];
                $migrations = array_merge($migrations, $files);
            }
        }

        sort($migrations);

        return $migrations;
    }
}
