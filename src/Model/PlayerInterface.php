<?php

declare(strict_types=1);

namespace Chess\Model;

use Chess\Manager\MovesManagerInterface;

interface PlayerInterface
{
    /**
     * Player constructor
     *
     * @param MovesManagerInterface $manager Player's moves manager
     */
    public function __construct(MovesManagerInterface $manager);

    /**
     * Get player id
     *
     * @return int
     */
    public function id() : int;

    /**
     * @return MovesManagerInterface|null
     */
    public function move(): ?MovesManagerInterface;

    /**
     * Set if player moves upwards or downwards y-axis
     *
     * @param bool $flag true means player plays towards y-axis (y should ascend)
     */
    public function setMovesUpwards(bool $flag = true);

    /**
     * Check if players moves upwards y-axis
     *
     * @return bool
     */
    public function doesMoveUpwards() : bool;
}
