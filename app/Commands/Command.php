<?php

declare(strict_types=1);

namespace App\Commands;

use DragonCode\Support\Facades\Filesystem\Directory;
use DragonCode\Support\Facades\Instances\Instance;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends BaseCommand
{
    protected ?string $template = null;

    abstract protected function handle(OutputInterface $output): void;

    protected function configure(): void
    {
        $this->setName($this->commandName());
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->handle($output);

        return static::SUCCESS;
    }

    protected function projects(): array
    {
        return Directory::allPaths($this->basePath('src'));
    }

    protected function template(): string
    {
        return $this->basePath($this->template);
    }

    protected function basePath(?string $path = null): string
    {
        return __DIR__ . '/../../' . $path;
    }

    protected function commandName(): string
    {
        return Instance::basename($this);
    }
}
