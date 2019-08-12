<?php

namespace Tnt\Helpers;

use Oak\Console\Facade\Console;
use Oak\Contracts\Container\ContainerInterface;
use Oak\ServiceProvider;
use Tnt\Helpers\Console\Cli;
use Tnt\Helpers\Console\Email\Email;
use Tnt\Helpers\Console\Newsletter\Newsletter;
use Tnt\Helpers\Console\Make\Make;
use Tnt\Helpers\Console\Media\Media;

class HelpersServiceProvider extends ServiceProvider
{
	public function boot(ContainerInterface $app)
	{
		Console::registerCommand(Cli::class);
		Console::registerCommand(Email::class);
		Console::registerCommand(Media::class);
		Console::registerCommand(Make::class);
		Console::registerCommand(Newsletter::class);
	}

	public function register(ContainerInterface $app)
	{
		$app->set(Cli::class, Cli::class);
		$app->set(Make::class, Make::class);
		$app->set(Email::class, Email::class);
		$app->set(Media::class, Media::class);
		$app->set(Newsletter::class, Newsletter::class);
	}
}