<?php

declare(strict_types=1);

namespace Chess\Model;

use Chess\Manager\PlayersManagerInterface;

interface GameInterface
{
    /**
     * Game constructor.
     *
     * @param BoardInterface          $board Board that game is being played on
     * @param PlayersManagerInterface $players Players that participate in game
     */
    public function __construct(BoardInterface $board, PlayersManagerInterface $players);

    /**
     * Get board instance that game is being played on.
     *
     * @return BoardInterface
     */
    public function board() : BoardInterface;

    /**
     * Get player instance.
     *
     * @param string $key Usually either 'whites' or 'blacks'
     */
    public function player(string $key);
}
