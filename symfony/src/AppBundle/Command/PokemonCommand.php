<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class PokemonCommand extends ContainerAwareCommand
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

        $doctrine = $this->getContainer()->get('doctrine');

        $entityManager = $doctrine->getEntityManager();



        for ($i=1; $i <=151 ; $i++) {

            $pokemoncontent = file_get_contents('http://pokeapi.co/api/v2/pokemon/'.$i);

            $pokemoncontent = json_decode($pokemoncontent,true);

            $name = $pokemoncontent['name'];

            $pokemon = new Pokemon();

            $pokemon->setName($name);

            $pokemon->setNumber($i);

            $entityManager->persist($pokemon);

            $entityManager->flush();
        }
        
        


        //$output->writeln('Pokemon!');
    }
}
