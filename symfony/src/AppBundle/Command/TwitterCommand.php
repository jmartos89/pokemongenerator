<?php

namespace AppBundle\Command;

use AppBundle\Service\TwitterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TwitterCommand extends Command
{
    /** @var TwitterService */
    private $twitterService;

    public function __construct($name = null, TwitterService $twitterService)
    {
        parent::__construct($name);
        $this->twitterService = $twitterService;
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:twitter:test')

            // the short description shown while running "php bin/console list"
            ->setDescription('Test twitter api.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tweets = $this->twitterService->getTweets(1);
        $output->writeln($tweets);
    }
}
