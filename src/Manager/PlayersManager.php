<?php

declare(strict_types=1);

namespace Chess\Manager;

use Chess\Exceptions\PlayerException;
use Chess\Manager\PlayersManagerInterface as PlayersManagerInterface;
use Chess\Model\Player;
use Chess\Model\PlayerInterface as PlayerInterface;

class PlayersManager implements PlayersManagerInterface
{
    /**
     * @var Player[]
     */
    protected array $players;

    /**
     * @param Player $whites
     * @param Player $blacks
     */
    public function __construct(PlayerInterface $whites, PlayerInterface $blacks)
    {
        $whites->setMovesUpwards();
        $blacks->setMovesUpwards(false);

        $this->players = compact('whites', 'blacks');
    }

    /**
     * @param string $key
     * @return Player
     *
     * @throws PlayerException
     */
    public function get(string $key) : PlayerInterface
    {
        if (! array_key_exists($key, $this->players)) {
            throw new PlayerException("Player key $key is invalid");
        }

        return $this->players[$key];
    }
}
