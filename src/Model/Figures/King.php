<?php

declare(strict_types=1);

namespace Chess\Model\Figures;

use Chess\Model\Figures\FigureInterface as FigureInterface;
use Chess\Traits\Figures\Moves\Alongside;
use Chess\Traits\Figures\Moves\Askew;

class King extends AbstractFigure implements KingInterface
{
    use Askew, Alongside;

    /**
     * {@inheritdoc}
     */
    public function id(): string
    {
        return 'k';
    }

    /**
     * {@inheritdoc}
     */
    public function canMoveTo(string $x, int $y): bool
    {
        $rangeX = range($this->x, $x);
        $countX = count($rangeX) - 1;
        $countY = abs($this->y - $y);

        if (
            $countX <= 1
            &&
            $countY <= 1
            &&
            (
                $this->canMoveAskew($x, $y)
                ||
                $this->canMoveAlongside($x, $y)
            )
            &&
            ! $this->isCheckedBy($this->getEnemyFigures(), $x, $y)
        ) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isMoveCastling(string $x, int $y): bool
    {
        return $this->getBoardStart() === $y && $this->getDistance($x, $y) === 2;
    }

    /**
     * {@inheritdoc}
     */
    public function canCastle(string $x, int $y): bool
    {
        $range = range($this->x, $x);
        $enemyFigures = $this->getEnemyFigures();

        foreach ($range as $toX) {
            if ($this->isCheckedBy($enemyFigures, $toX, $y)) {
                return false;
            }
        }

        if ($this->wasMoved()) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getCastlingPartnerPosition(string $x, int $y): array
    {
        $width = $this->board->width();

        $toX = $x > $this->x ? array_pop($width) : array_shift($width);

        return [$toX, $y];
    }

    /**
     * {@inheritdoc}
     */
    public function getCastlingPartnerDestination(string $x, int $y): array
    {
        $range = range($this->x, $x);

        return [$range[1], $y];
    }

    /**
     * @param string $x
     * @param int    $y
     *
     * @return int
     */
    protected function getDistance(string $x, int $y): int
    {
        return count(range($this->x, $x)) - 1;
    }

    /**
     * Determine whether figure is checked.
     *
     * @param FigureInterface[] $enemyFigures
     * @param string $x
     * @param int    $y
     *
     * @return bool
     */
    protected function isCheckedBy(array $enemyFigures, string $x, int $y): bool
    {
        foreach ($enemyFigures as $figure) {
            if ($figure->canMoveTo($x, $y)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns array of enemy figures that are on board.
     *
     * @return FigureInterface[]
     */
    protected function getEnemyFigures(): array
    {
        // Get every field
        $fields = $this->board->fields();

        // Remove current figure
        unset($fields[$this->x][$this->y]);


//        dd($fields);
        // Flatten array
        $flat = call_user_func_array('array_merge', array_values($fields));

        // Filter empty fields and return only enemy figures
        return array_filter($flat, function ($figure) {
//            dd($figure);
            /* @var FigureInterface|null $figure */
            return $figure !== null && $figure->getPlayer() !== $this->getPlayer();
        });
    }

    /**
     * Get starting row of board.
     *
     * @return int
     */
    protected function getBoardStart(): int
    {
        $height = $this->board->height();

        if ($this->getPlayer()->doesMoveUpwards()) {
            return array_shift($height);
        } else {
            return array_pop($height);
        }
    }
}
