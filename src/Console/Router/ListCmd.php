<?php

namespace Tnt\Helpers\Console\Router;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;

class ListCmd extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('list')
			->setDescription('List all registered routes')
			;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$routes = \dry\route\Router::$routes;

		$output->writeLine(
			str_pad('LANGUAGE', 10).
			str_pad('PREFIX', 15).
			str_pad('PATTERN', 65).
			'CONTROLLER', OutputInterface::TYPE_INFO);

		foreach ($routes as $route) {

			foreach ($route[2] as $pattern => $controller) {

				if (is_array($controller)) {
					$controller = $controller[0];
				} else if(is_string($controller)) {
					// ok
				} else if(is_callable($controller)) {
					$controller = 'closure';
				}

				$output->writeLine(
					str_pad($route[0] ? $route[0] : '-', 10).
					str_pad($route[1] ? $route[1] : '-', 15).
					str_pad((strlen($pattern) > 60 ? substr($pattern, 0, 60).'...' : $pattern), 65).
					(strlen($controller) > 60 ? substr($controller, 0, 60).'...' : $controller)
				);
			}
		}
	}
}