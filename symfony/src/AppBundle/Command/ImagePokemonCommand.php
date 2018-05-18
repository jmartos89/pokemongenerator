<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


class ImagePokemonCommand extends ContainerAwareCommand
{
    const MAX_POKEMON_NUMBER = 151;

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:pokemon:imagepokemon')

            // the short description shown while running "php bin/console list"
            ->setDescription('Download pokemon images')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        for ($i = 1; $i <= PokemonCommand::MAX_POKEMON_NUMBER; $i++) {

            $imageName = sprintf('%s.png',str_pad($i, 3, "0", STR_PAD_LEFT)); 

            $downloadUrl = sprintf('https://assets.pokemon.com/assets/cms2/img/pokedex/full/%s', $imageName);

            $saveUrl = sprintf('web/images/%s', $imageName);

            $pokemonImage = file_get_contents($downloadUrl);

            file_put_contents($saveUrl, $pokemonImage);

            $message = sprintf('Saving image %s... ', $imageName);

            $output->writeln($message);
        }    
    }
}
