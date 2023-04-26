<?php

declare(strict_types=1);

namespace Chess;

use Chess\Interfaces\MovesManagerFactory as MovesManagerFactoryInterface;
use Chess\Interfaces\Board as BoardInterface;
use Chess\Interfaces\MovesManager as MovesManagerInterface;

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
