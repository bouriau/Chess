<?php

declare(strict_types=1);

namespace Chess\Interfaces;

interface MovesManagerFactory
{
    /**
     * @param Board $board Board that this manager should belong to
     */
    public function __construct(Board $board);

    /**
     * Create moves manager that belongs to board provided in constructor.
     *
     * @return MovesManager
     */
    public function make() : MovesManager;
}
