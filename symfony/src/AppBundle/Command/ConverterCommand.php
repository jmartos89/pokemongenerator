<?php

namespace AppBundle\Command;

use AppBundle\Service\ConverterService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConverterCommand extends Command
{
    /** @var ConverterService */
    private $converterService;

    public function __construct($name = null, ConverterService $converterService)
    {
        parent::__construct($name);
        $this->converterService = $converterService;
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:convert:name')

            // the short description shown while running "php bin/console list"
            ->setDescription('Convert name.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $number = $this->converterService->converterNameInPokemonNumber(uniqid());

        $output->write($number);
    }
}
