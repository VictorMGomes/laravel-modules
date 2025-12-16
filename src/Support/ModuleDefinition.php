<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Support;

use Illuminate\Support\Str;

readonly class ModuleDefinition
{
    public string $studlyName;

    public string $namespace;

    public string $path;

    public string $providerClass;

    public string $providerPath;

    public function __construct(string $name)
    {
        $this->studlyName = Str::studly($name);

        $this->namespace = "Modules\\{$this->studlyName}";

        $this->path = base_path("modules/{$this->studlyName}");
        $this->providerClass = "Modules\\{$this->studlyName}\\Providers\\{$this->studlyName}ModuleServiceProvider::class";
        $this->providerPath = "{$this->path}/Providers/{$this->studlyName}ModuleServiceProvider.php";
    }

    public function exists(): bool
    {
        return is_dir($this->path);
    }
}
