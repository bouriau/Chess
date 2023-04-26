<?php

declare(strict_types=1);

namespace Chess;

use Chess\Interfaces\PlayerFactory as PlayerFactoryInterface;
use Chess\Interfaces\MovesManagerFactory as MovesManagerFactoryInterface;
use Chess\Interfaces\Player as PlayerInterface;

class PlayerFactory implements PlayerFactoryInterface
{
    /**
    * {@inheritdoc}
    */
    public function __construct(protected MovesManagerFactoryInterface $factory)
    {
    }

    /**
    * {@inheritdoc}
    */
    public function make(): PlayerInterface
    {
        return new Player($this->factory->make());
    }
}
