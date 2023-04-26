<?php

declare(strict_types=1);

namespace Chess\Interfaces\Figures;

/**
 * This interface should be implemented to king.
 * Stacking this figure should lead to victory of opposite player.
 */
interface King extends Castles
{
    /**
     * Checks whether move is castling
     *
     * @param string $x
     * @param int    $y
     *
     * @return bool
     */
    public function isMoveCastling(string $x, int $y): bool;

    /**
     * Get current coordinates of castling partner
     *
     * @param string $x
     * @param int    $y
     *
     * @return array [x, y] values
     */
    public function getCastlingPartnerPosition(string $x, int $y): array;

    /**
     * Get destination coordinates of castling partner
     *
     * @param string $x
     * @param int    $y
     *
     * @return array [x, y] values
     */
    public function getCastlingPartnerDestination(string $x, int $y): array;

}
