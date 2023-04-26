<?php

declare(strict_types=1);

namespace Chess\Factory;

use Chess\Factory\MovesManagerFactoryInterface as MovesManagerFactoryInterface;
use Chess\Manager\MovesManager;
use Chess\Manager\MovesManagerInterface as MovesManagerInterface;
use Chess\Model\BoardInterface as BoardInterface;

class MovesManagerFactory implements MovesManagerFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(protected BoardInterface $board)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function make(): MovesManagerInterface
    {
        return new MovesManager($this->board);
    }
}
