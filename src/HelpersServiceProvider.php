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
use Tnt\Helpers\Console\Router\Router;
use Tnt\Helpers\Console\Template\Template;

class HelpersServiceProvider extends ServiceProvider
{
    public function boot(ContainerInterface $app)
    {
        if ($app->isRunningInConsole()) {
            Console::registerCommand(Cli::class);
            Console::registerCommand(Email::class);
            Console::registerCommand(Media::class);
            Console::registerCommand(Make::class);
            Console::registerCommand(Newsletter::class);
            Console::registerCommand(Router::class);
            Console::registerCommand(Template::class);
        }
    }

    public function register(ContainerInterface $app)
    {
        if ($app->isRunningInConsole()) {
            $app->set(Cli::class, Cli::class);
            $app->set(Make::class, Make::class);
            $app->set(Email::class, Email::class);
            $app->set(Media::class, Media::class);
            $app->set(Newsletter::class, Newsletter::class);
            $app->set(Router::class, Router::class);
            $app->set(Template::class, Template::class);
        }
    }
}