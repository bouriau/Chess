<?php

declare(strict_types=1);

namespace Chess\Manager;

use Chess\Model\PlayerInterface;

interface PlayersManagerInterface
{
    /**
     * @param PlayerInterface $whites white figures player
     * @param PlayerInterface $blacks black figures player
     */
    public function __construct(PlayerInterface $whites, PlayerInterface $blacks);

    /**
     * Gets player instance
     *
     * @param string $key Usually either 'whites' or 'blacks'. Could vary on implementation
     *
     * @return PlayerInterface
     */
    public function get(string $key) : PlayerInterface;
}
