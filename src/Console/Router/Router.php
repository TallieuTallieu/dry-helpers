<?php

namespace Tnt\Helpers\Console\Router;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class Router extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('router')
			->addSubCommand(new ListCmd())
			;
	}
}