<?php

namespace Tnt\Helpers\Console\Email;

use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;

class Email extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('email')
			->addSubCommand(new CreateChannel())
			->addSubCommand(new ListChannels())
			;
	}
}