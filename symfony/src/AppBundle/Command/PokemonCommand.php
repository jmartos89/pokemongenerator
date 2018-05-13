<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PokemonCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:pokemon:create')

            // the short description shown while running "php bin/console list"
            ->setDescription('Create all pokemon.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pokemon = file_get_contents('http://pokeapi.co/api/v2/pokemon/1');

        $pokemon = json_decode($pokemon,true);

        $name = $pokemon['name'];
        

        var_dump($name);

        //$output->writeln('Pokemon!');
    }
}
