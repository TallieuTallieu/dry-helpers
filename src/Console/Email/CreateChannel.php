<?php

namespace Tnt\Helpers\Console\Email;

use dry\db\FetchException;
use dry\email\Channel;
use Oak\Console\Command\Argument;
use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;

class CreateChannel extends Command
{
    protected function createSignature(Signature $signature): Signature
    {
        return $signature
            ->setName('create-channel')
            ->setDescription('Create an email channel')
            ->addArgument(Argument::create('hid')->setDescription('The human id of the email channel'))
            ->addArgument(Argument::create('email')->setDescription('The from email for the email channel'))
            ->addArgument(Argument::create('name')->setDescription('The from name for the email channel'))
            ->addArgument(Argument::create('recipients')->setDescription('Recipients for the email channel, divided by comma'))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try
        {
            Channel::load_by('hid', strtolower($input->getArgument('hid')));
            $output->writeLine('Email channel already exists', OutputInterface::TYPE_ERROR);
            return;
        }
        catch( FetchException $e )
        {
            // @PASS
        }

        $channel = new Channel();
        $channel->hid = strtolower($input->getArgument('hid'));
        $channel->from_email = $input->getArgument('email');
        $channel->from_name = $input->getArgument('name');
        $channel->recipients = explode(',', $input->getArgument('recipients'));
        $channel->save();

        $output->writeLine('Email channel created');
    }
}