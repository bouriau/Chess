<?php

declare(strict_types=1);

namespace Chess\Model;

use Chess\Manager\PlayersManagerInterface as PlayersManagerInterface;
use Chess\Model\BoardInterface as BoardInterface;
use Chess\Model\GameInterface as GameInterface;
use Chess\Model\PlayerInterface as PlayerInterface;

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
