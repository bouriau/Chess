<?php

declare(strict_types=1);

namespace Chess;

use Chess\Interfaces\Player as PlayerInterface;
use Chess\Interfaces\MovesManager as MovesManagerInterface;

class Player implements PlayerInterface
{
    /**
     * @var MovesManager
     */
    protected MovesManager $manager;

    /**
     * @var bool
     */
    protected bool $movesUpwards = false;

    /**
     * Players counter, so we can create unique id
     * It depends on implementation
     * Feel free to change it in your own implementation
     *
     * @var int
     */
    public static int $playersCount = 1;

    /**
     * @var int
     */
    private int $id;

    /**
     * {@inheritdoc}
     */
    public function __construct(MovesManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->manager->setPlayer($this);
        $this->id = self::$playersCount++;
    }

    /**
     * {@inheritdoc}
     */
    public function id() : int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function move(...$args): ?MovesManagerInterface
    {
        $argc = count($args);

        if ($argc === 0) {
            return $this->manager;
        }

        return $this->manager->notation(array_shift($args));
    }

    /**
     * {@inheritdoc}
     */
    public function setMovesUpwards(bool $flag = true): void
    {
        $this->movesUpwards = $flag;
    }

    /**
     * {@inheritdoc}
     */
    public function doesMoveUpwards(): bool
    {
        return $this->movesUpwards;
    }
}
