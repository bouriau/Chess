<?php

declare(strict_types=1);

namespace Chess\Manager;

use Chess\Model\BoardInterface;
use Chess\Model\MoveInterface;
use Chess\Model\PlayerInterface;

interface MovesManagerInterface
{
    public function __construct(BoardInterface $board);
    public function setPlayer(PlayerInterface $player);
    public function getBoard() : BoardInterface;
    public function getPlayer() : PlayerInterface;
    public function from(string $from) : MoveInterface;
    public function notation(string $value);
}
