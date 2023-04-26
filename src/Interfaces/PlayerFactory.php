<?php

declare(strict_types=1);

namespace Chess\Interfaces;

interface PlayerFactory
{
    /**
     * @param MovesManagerFactory $manager Moves manager factory
     */
    public function __construct(MovesManagerFactory $manager);

    /**
     * Creates player instance using MovesManagerFactory from constructor
     * 
     * @return Player
     */
    public function make() : Player;
}
