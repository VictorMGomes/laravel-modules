<?php

declare(strict_types=1);

namespace Victormgomes\LaravelModules\Traits;

use RuntimeException;

trait RunSafeCommands
{
    protected function runSafe(string $command, array $arguments = []): void
    {
        if (! $this->hasCommand($command)) {
            $this->components->warn("Skipping [{$command}]: not found.");

            return;
        }

        $description = "Running {$command}";

        $exitCode = $this->call($command, $arguments);

        if ($exitCode !== 0) {
            throw new RuntimeException("Command [{$command}] failed.");
        }
    }

    protected function hasCommand(string $name): bool
    {
        return array_key_exists($name, $this->getApplication()->all());
    }
}
