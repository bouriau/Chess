<?php

declare(strict_types=1);

namespace Chess\Model;

use Chess\Exceptions\MoveException;
use Chess\Exceptions\PromotionException;
use Chess\Model\BoardInterface as BoardInterface;
use Chess\Model\Figures\CastlesInterface;
use Chess\Model\Figures\FigureInterface as FigureInterface;
use Chess\Model\Figures\KingInterface;
use Chess\Model\Figures\PromotesInterface;
use Chess\Model\MoveInterface as MoveInterface;
use Chess\Model\PlayerInterface as PlayerInterface;
use ReflectionClass;

class Move implements MoveInterface
{
    /**
     * @var ?string
     */
    protected ?string $promotes = null;

    /**
     * @param BoardInterface $board
     * @param PlayerInterface $player
     * @param string $from
     */
    public function __construct(
        protected BoardInterface $board,
        protected PlayerInterface $player,
        protected string $from
    )
    {
    }

    /**
     * @throws MoveException
     * @throws PromotionException
     */
    public function to(string $to): bool
    {
        $from = $this->splitCords($this->from);
        $to = $this->splitCords($to);

        list($fromX, $fromY) = $from;
        list($toX, $toY) = $to;

        $fromY = (int) $fromY;
        $toY = (int) $toY;

        if ($fromX === $toX && $fromY === $toY) {
            throw new MoveException('No move was made ("from" is the same as "to")');
        }

        $this->checkBoundaries($fromX, $fromY, $toX, $toY);

        $fromFigure = $this->board->get($fromX, $fromY);

        if (! $fromFigure instanceof FigureInterface) {
            throw new MoveException('Could not find figure on ' .$fromX.$fromY);
        }

        if ($fromFigure->getPlayer() !== $this->player) {
            throw new MoveException("Figure on $fromX$fromY does not belong to you");
        }

        if (
            $fromFigure instanceof KingInterface
            &&
            $fromFigure->isMoveCastling($toX, $toY)
            &&
            $fromFigure->canCastle($toX, $toY)
        ) {
            $this->handleCastling($fromFigure, $toX, $toY);
        } else if (! $fromFigure->canMoveTo($toX, $toY)) {
            $figureClass = get_class($fromFigure);

            throw new MoveException("You cannot move figure $figureClass from $fromX$fromY to $toX$toY");
        }

        $this->board->remove($fromX, $fromY);

        if ($fromFigure->isAttack($toX, $toY)) {
            $this->board->stack($toX, $toY);
        }

        if ($fromFigure instanceof PromotesInterface && $fromFigure->canPromote($toX, $toY)) {
            if (! $this->promotes) {
                throw new PromotionException("No figure defined for promotion");
            }

            $fromFigure = $this->board->unstack($fromFigure->getPlayer(), $this->promotes);
        }

        $this->board->set($toX, $toY, $fromFigure);

        return true;
    }

    public function from(string $from): static
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @throws PromotionException
     */
    public function promotes(string $figure): static
    {
        if (! class_exists($figure)) {
            throw new PromotionException("Class $figure does not exists");
        }

        $reflection = new ReflectionClass($figure);
        $figureInterface = FigureInterface::class;

        if (! $reflection->implementsInterface($figureInterface)) {
            throw new PromotionException("Class $figure must implement $figureInterface interface");
        }

        $this->promotes = $figure;

        return $this;
    }

    /**
     * @param FigureInterface $figure
     * @param string $x
     * @param int $y
     * @throws MoveException
     */
    protected function handleCastling(FigureInterface $figure, string $x, int $y): void
    {
        list ($currentX, $currentY) =  $figure->getCastlingPartnerPosition($x, $y);

        $castlingFigure = $this->board->get($currentX, $currentY);

        if (! $castlingFigure instanceof CastlesInterface) {
            throw new MoveException("Figure at the end of the board ($currentX$currentY) cannot partake in castling");
        }

        list ($castlingX, $castlingY) = $figure->getCastlingPartnerDestination($x, $y);

        if (! $castlingFigure->canCastle($castlingX, $castlingY)) {
            throw new MoveException("Castling figure at $currentX$currentY is not allowed to castle");
        }

        if (! $castlingFigure->canMoveTo($castlingX, $castlingY)) {
            throw new MoveException("Castling figure cannot be moved from $currentX$currentY to $castlingX$castlingY");
        }

        // Move castling figure
        $this->board->remove($currentX, $currentY);
        $this->board->set($castlingX, $castlingY, $castlingFigure);
    }

    /**
     * @param string $value
     * @return array
     *
     * @throws MoveException
     */
    protected function splitCords(string $value): array
    {
        preg_match('/([a-z]+?)([1-9]+?)/', $value, $matches);

        // Drop first key
        array_shift($matches);

        // Check if cords are correct
        if (count($matches) !== 2 && is_string($matches[0]) && is_numeric($matches[1])) {
            throw new MoveException("Given coordinates ($value) are invalid");
        }

        return array_map('strtolower', $matches);
    }

    /**
     * Checks if move is in boundaries. If it's not, throws exception.
     *
     * @param string $fromX
     * @param int    $fromY
     * @param string $toX
     * @param int    $toY
     *
     * @throws MoveException
     */
    protected function checkBoundaries(string $fromX, int $fromY, string $toX, int $toY): void
    {
        $width = $this->board->width();
        $height = $this->board->height();

        if (! in_array($fromX, $width, true) || ! in_array($fromY, $height, true)) {
            throw new MoveException("From ($fromX$fromY) is beyond board boundaries");
        }

        if (! in_array($toX, $width, true) || ! in_array($toY, $height, true)) {
            throw new MoveException("To ($toX$toY) is beyond board boundaries");
        }
    }
}
