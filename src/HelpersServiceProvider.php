<?php

namespace Tnt\Helpers;

use Oak\Console\Facade\Console;
use Oak\Contracts\Container\ContainerInterface;
use Oak\ServiceProvider;
use Tnt\Helpers\Console\Cli;
use Tnt\Helpers\Console\Make\Make;
use Tnt\Helpers\Console\Media\Media;

class HelpersServiceProvider extends ServiceProvider
{
	public function boot(ContainerInterface $app)
	{
		Console::registerCommand(Cli::class);
		Console::registerCommand(Make::class);
		Console::registerCommand(Media::class);
	}

	public function register(ContainerInterface $app)
	{
		$app->set(Cli::class, Cli::class);
		$app->set(Make::class, Make::class);
		$app->set(Media::class, Media::class);
	}
}