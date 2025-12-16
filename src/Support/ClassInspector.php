<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Support;

class ClassInspector
{
    public static function getModuleNameFromProvider(string $providerClass): ?string
    {
        if (preg_match('/Modules\\\\(.*?)\\\\Providers/', $providerClass, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public static function getClassFullNameFromFile(string $filePath): ?string
    {
        try {
            $contents = file_get_contents($filePath);
            if ($contents === false) {
                return null;
            }

            $namespace = null;
            $class = null;

            if (preg_match('/^namespace\s+(.+?);/m', $contents, $matches)) {
                $namespace = $matches[1];
            }

            if (preg_match('/^class\s+(\w+)/m', $contents, $matches)) {
                $class = $matches[1];
            }

            if ($class) {
                return $namespace ? "$namespace\\$class" : $class;
            }

            return null;

        } catch (\Throwable) {
            return null;
        }
    }
}
