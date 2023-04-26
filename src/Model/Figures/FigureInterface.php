<?php

declare(strict_types=1);

namespace Chess\Model\Figures;

use Chess\Model\BoardInterface;
use Chess\Model\PlayerInterface;

interface FigureInterface
{
    /**
     * Figure constructor.
     *
     * @param string $x Figure x-axis position
     * @param int    $y Figure y-axis position
     * @param BoardInterface  $board Board that this figure belongs to
     * @param PlayerInterface $player Player which this figure belongs to
     */
    public function __construct(string $x, int $y, BoardInterface $board, PlayerInterface $player);

    /**
     * Get figure id (usually one letter, like n for knight).
     * In algebraic chess notation there is no notation for pawn.
     * For this package you should use some letter (for example p) to identify pawn.
     *
     * @return string
     */
    public function id() : string;

    /**
     * Get figure owner instance.
     *
     * @return PlayerInterface
     */
    public function getPlayer() : PlayerInterface;

    /**
     * Sets figure x coordinates.
     *
     * @param string $x
     */
    public function setX(string $x);

    /**
     * Sets figure y coordinates.
     *
     * @param int $y
     */
    public function setY(int $y);

    /**
     * Checks whether figure was already moved.
     *
     * @return bool
     */
    public function wasMoved() : bool;

    /**
     * Checks if figure can move to given field (including attacks).
     *
     * @param string $x
     * @param int    $y
     *
     * @return bool
     */
    public function canMoveTo(string $x, int $y) : bool;

    /**
     * Checks if move to given field is attack.
     *
     * @param string $x
     * @param int    $y
     *
     * @return bool
     */
    public function isAttack(string $x, int $y) : bool;
}
