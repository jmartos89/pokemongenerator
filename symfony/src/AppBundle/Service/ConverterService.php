<?php

namespace AppBundle\Service;

class ConverterService
{
    const MAX_POKEMON_NUMBER = 802;

    public function converterNameInPokemonNumber($name)
    {
        $number = crc32($name);

        return $number % ConverterService::MAX_POKEMON_NUMBER;
    }
}
