<?php

declare(strict_types=1);

namespace Chess\Model\Figures;

use Chess\Model\BoardInterface as BoardInterface;
use Chess\Model\PlayerInterface as PlayerInterface;

abstract class AbstractFigure implements FigureInterface
{
    /**
     * Board that figure belongs to.
     *
     * @var BoardInterface
     */
    protected BoardInterface $board;

    /**
     * Owner of the figure.
     *
     * @var PlayerInterface
     */
    protected PlayerInterface $player;

    /**
     * Current figure x-axis position.
     *
     * @var string
     */
    protected string $x;

    /**
     * Current figure y-axis position.
     *
     * @var int
     */
    protected int $y;

    /**
     * Figure starting x-axis position.
     *
     * @var string
     */
    protected string $startX;

    /**
     * Figure starting y-axis position.
     *
     * @var int
     */
    protected int $startY;

    /**
     * Determines if figure was moved.
     *
     * @var bool
     */
    protected bool $wasMoved = false;

    /**
     * {@inheritdoc}
     */
    public function __construct(string $x, int $y, BoardInterface $board, PlayerInterface $player)
    {
        $this->x = $this->startX = $x;
        $this->y = $this->startY = $y;
        $this->board = $board;
        $this->player = $player;
    }

    /**
     * {@inheritdoc}
     */
    public function getPlayer() : PlayerInterface
    {
        return $this->player;
    }

    /**
     * {@inheritdoc}
     */
    public function isAttack(string $x, int $y) : bool
    {
        $figure = $this->board->get($x, $y);

        return $figure !== null && $this->player !== $figure->getPlayer();
    }

    /**
     * {@inheritdoc}
     */
    public function setX(string $x): void
    {
        if ($x !== $this->x) {
            $this->wasMoved = true;
            $this->x = $x;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setY(int $y): void
    {
        if ($y !== $this->y) {
            $this->wasMoved = true;
            $this->y = $y;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function wasMoved(): bool
    {
        return $this->wasMoved;
    }
}
