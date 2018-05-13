<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class PokemonCommand extends ContainerAwareCommand
{
    const MAX_POKEMON_NUMBER = 151;

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

        /** @var EntityManager $entityManager */
        $entityManager = $doctrine->getEntityManager();

        for ($i = 1; $i <= PokemonCommand::MAX_POKEMON_NUMBER; $i++) {

            $url = sprintf('http://pokeapi.co/api/v2/pokemon/%s', $i);
            $pokemonContent = file_get_contents($url);

            $pokemonInfo = json_decode($pokemonContent, true);

            if (isset($pokemonInfo['name'])) {
                $name = $pokemonInfo['name'];

                $pokemon = new Pokemon();

                $pokemon->setName($name);
                $pokemon->setNumber($i);

                $entityManager->persist($pokemon);

                $message = sprintf('Adding #%s %s... ', $i, $name);

                $output->writeln($message);
            }
        }

        $entityManager->flush();
    }
}
