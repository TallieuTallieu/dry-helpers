<?php

namespace Tnt\Helpers\Console\Email;

use dry\email\Channel;
use Oak\Console\Command\Command;
use Oak\Console\Command\Signature;
use Oak\Contracts\Console\InputInterface;
use Oak\Contracts\Console\OutputInterface;
use Oak\Contracts\Container\ContainerInterface;
use Tnt\ConsoleTable\Table;

class ListChannels extends Command
{
    /**
     * @var Table $table
     */
    private $table;

    /**
     * ListChannels constructor.
     * @param ContainerInterface $app
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
            ->setName('list-channels')
            ->setDescription('Lists all email channels for this application')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->table->setHeaders(['Hid', 'From email', 'From name', 'Recipients']);

        foreach (Channel::all() as $channel) {

            $recipients = $channel->recipients ? $channel->recipients : [];

            $this->table->addRow([
                $channel->hid,
                $channel->from_email,
                $channel->from_name,
                implode(', ', $recipients),
            ]);
        }
    }
}