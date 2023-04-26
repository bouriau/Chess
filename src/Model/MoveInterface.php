<?php

declare(strict_types=1);

namespace Chess\Model;

interface MoveInterface
{
    public function __construct(BoardInterface $board, PlayerInterface $player, string $from);
    public function from(string $from);
    public function to(string $to);
    public function promotes(string $figure);
}
