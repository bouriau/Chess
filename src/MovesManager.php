<?php

declare(strict_types=1);

namespace Chess;

use Chess\Interfaces\Board as BoardInterface;
use Chess\Interfaces\Player as PlayerInterface;
use Chess\Interfaces\Move as MoveInterface;
use Chess\Interfaces\MovesManager as MovesManagerInterface;

class MovesManager implements MovesManagerInterface
{
    /**
     * @var BoardInterface
     */
    protected BoardInterface $board;

    /**
     * @var PlayerInterface
     */
    protected PlayerInterface $player;

    /**
     * @param Board $board
     */
    public function __construct(BoardInterface $board)
    {
        $this->board = $board;
    }

    public function getPlayer(): PlayerInterface
    {
        return $this->player;
    }

    public function setPlayer(PlayerInterface $player): void
    {
        $this->player = $player;
    }

    public function getBoard() : BoardInterface
    {
        return $this->board;
    }

    public function from(string $from) : MoveInterface
    {
        return new Move($this->getBoard(), $this->getPlayer(), $from);
    }

    public function notation(string $value)
    {
        throw new \LogicException('Notation movements are not implemented yet');
    }
}
