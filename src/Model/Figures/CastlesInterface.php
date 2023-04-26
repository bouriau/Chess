<?php

namespace Chess\Model\Figures;

/**
 * Implement this feature if figure can perform castling
 */
interface CastlesInterface
{
    /**
     * Whether figure is allowed to castle.
     * It should not check if the castle is possible at all,
     * but whether figure is allowed to perform castling (including move)
     *
     * @param string $x
     * @param int $y
     * @return bool
     */
    public function canCastle(string $x, int $y) : bool;
}
