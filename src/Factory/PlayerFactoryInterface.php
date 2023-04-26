<?php

declare(strict_types=1);

namespace Chess\Factory;

use Chess\Model\PlayerInterface;

interface PlayerFactoryInterface
{
    /**
     * @param MovesManagerFactoryInterface $manager Moves manager factory
     */
    public function __construct(MovesManagerFactoryInterface $manager);

    /**
     * Creates player instance using MovesManagerFactory from constructor
     * 
     * @return PlayerInterface
     */
    public function make() : PlayerInterface;
}
