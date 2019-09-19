<?php

namespace Tnt\Helpers\Console\Router;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Contracts\Container\ContainerInterface;
use Tnt\ConsoleTable\Table;

class Router extends Command
{
    /**
     * @var Table $table
     */
    private $table;

    /**
     * Router constructor.
     * @param Table $table
     */
    public function __construct(ContainerInterface $app, Table $table)
    {
        $this->table = $table;
        parent::__construct($app);
    }

    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('router')
            ->setDescription('List all registered routes')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $routes = \dry\route\Router::$routes;

        $this->table->setHeaders(['Language', 'Prefix', 'Pattern', 'Controller',]);

        foreach ($routes as $route) {

            foreach ($route[2] as $pattern => $controller) {

                if (is_array($controller)) {
                    $controller = $controller[0];
                } else if(is_string($controller)) {
                    // ok
                } else if(is_callable($controller)) {
                    $controller = 'closure';
                }

                $this->table->addRow([
                    $route[0] ? $route[0] : '-',
                    $route[1] ? $route[1] : '-',
                    $pattern,
                    $controller,
                ]);
            }
        }

        $this->table->output();
    }
}