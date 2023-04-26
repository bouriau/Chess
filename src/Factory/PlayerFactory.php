<?php

declare(strict_types=1);

namespace Chess\Factory;

use Chess\Factory\MovesManagerFactoryInterface as MovesManagerFactoryInterface;
use Chess\Factory\PlayerFactoryInterface as PlayerFactoryInterface;
use Chess\Model\Player;
use Chess\Model\PlayerInterface as PlayerInterface;

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
