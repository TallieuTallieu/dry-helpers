<?php

namespace Tnt\Helpers\Console\Email;

use dry\email\Channel;
use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;

class ListChannels extends Command
{
	protected function createSignature(Signature $signature): Signature
	{
		return $signature
			->setName('list-channels')
			->setDescription('Lists all email channels for this application')
			;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeLine(
			str_pad('HID', 35).
			str_pad('FROM EMAIL', 35).
			str_pad('FROM NAME', 35).
			'RECIPIENTS'
		, OutputInterface::TYPE_INFO);

		foreach (Channel::all() as $channel) {

			$recipients = $channel->recipients ? $channel->recipients : [];

			$output->writeLine(
				str_pad($channel->hid, 35).
				str_pad($channel->from_email, 35).
				str_pad($channel->from_name, 35).
				implode(', ', $recipients)
			);
		}
	}
}