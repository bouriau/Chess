<?php

declare(strict_types=1);

namespace Chess\Factory;

use Chess\Manager\MovesManagerInterface;
use Chess\Model\BoardInterface;

interface MovesManagerFactoryInterface
{
    /**
     * @param BoardInterface $board Board that this manager should belong to
     */
    public function __construct(BoardInterface $board);

    /**
     * Create moves manager that belongs to board provided in constructor.
     *
     * @return MovesManagerInterface
     */
    public function make() : MovesManagerInterface;
}
