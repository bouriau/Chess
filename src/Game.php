<?php

declare(strict_types=1);

namespace Chess;

use Chess\Interfaces\Game as GameInterface;
use Chess\Interfaces\Board as BoardInterface;
use Chess\Interfaces\PlayersManager as PlayersManagerInterface;
use Chess\Interfaces\Player as PlayerInterface;

class Game implements GameInterface
{
    /**
     * @var BoardInterface
     */
    protected BoardInterface $board;

    /**
     * @var PlayersManagerInterface
     */
    protected PlayersManagerInterface $players;

    /**
     * {@inheritdoc}
     */
    public function __construct(BoardInterface $board, PlayersManagerInterface $players)
    {
        $this->board = $board;
        $this->players = $players;
    }

    /**
     * {@inheritdoc}
     */
    public function board() : BoardInterface
    {
        return $this->board;
    }

    /**
     * {@inheritdoc}
     */
    public function player(string $key) : PlayerInterface
    {
        return $this->players->get($key);
    }
}
