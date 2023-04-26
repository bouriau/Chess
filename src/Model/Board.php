<?php

declare(strict_types=1);

namespace Chess\Model;

use Chess\Exceptions\BoardException;
use Chess\Model\BoardInterface as BoardInterface;
use Chess\Model\Figures\FigureInterface as FigureInterface;
use Chess\Model\PlayerInterface as PlayerInterface;
use ReflectionClass;
use ReflectionException;

class Board implements BoardInterface
{
    protected array $fields;

    /**
     * @var string[]
     */
    protected array $width;

    /**
     * @var int[]
     */
    protected array $height;

    /**
     * @var FigureInterface[]
     */
    protected array $stack;

    public function __construct(string $width = 'h', int $height = 8)
    {
        $this->width = range('a', $width);
        $this->height = range(1, $height);

        foreach ($this->width as $x) {
            foreach ($this->height as $y) {
                $this->fields[$x][$y] = null;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function fields(): array
    {
        return $this->fields;
    }

    /**
     * {@inheritdoc}
     */
    public function width(): array
    {
        return $this->width;
    }

    /**
     * {@inheritdoc}
     */
    public function height(): array
    {
        return $this->height;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(array $fields): void
    {
        $this->fields = array_replace_recursive($this->fields, $fields);
    }

    /**
     * {@inheritdoc}
     * @throws BoardException|ReflectionException
     */
    public function add(string $x, int $y, PlayerInterface $player, mixed $figure): void
    {
        if (is_string($figure) && ! class_exists($figure)) {
            throw new BoardException("Class $figure does not exists");
        }

        $reflection = new ReflectionClass($figure);
        $figureInterface = FigureInterface::class;

        if (! $reflection->implementsInterface($figureInterface)) {
            throw new BoardException("Class $figure must implement $figureInterface");
        }

        /** @var FigureInterface $figure */
        if (is_string($figure)) {
            $figure = new $figure($x, $y, $this, $player);
        }

        $this->set($x, $y, $figure);
    }

    /**
     * {@inheritdoc}
     * @throws BoardException
     */
    public function set(string $x, int $y, FigureInterface $figure): void
    {
        if (! $this->isFieldInBoundaries($x, $y)) {
            throw new BoardException("Field $x$y is not in board boundaries");
        }

        $figure->setX($x);
        $figure->setY($y);

        $this->fields[$x][$y] = $figure;
    }

    /**
     * {@inheritdoc}
     * @throws BoardException
     */
    public function get(string $x, int $y): ?FigureInterface
    {
        if (! $this->isFieldInBoundaries($x, $y)) {
            throw new BoardException("Field $x$y is not in board boundaries");
        }

        return $this->fields[$x][$y];
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $x, int $y): void
    {
        $this->fields[$x][$y] = null;
    }

    /**
     * {@inheritdoc}
     * @throws BoardException
     */
    public function stack(string $x, int $y): void
    {
        $figure = $this->get($x, $y);
        $this->remove($x, $y);

        $playerIdentifier = $figure->getPlayer()->id();
        $figureClass = get_class($figure);

        if (! isset($this->stack[$playerIdentifier][$figureClass])) {
            $this->stack[$playerIdentifier][$figureClass] = [];
        }

        $this->stack[$playerIdentifier][$figureClass][] = $figure;
    }

    /**
     * {@inheritdoc}
     * @throws BoardException
     */
    public function unstack(PlayerInterface $player, string $figure) : FigureInterface
    {
        $playerIdentifier = $player->id();

        if (empty($this->stack[$playerIdentifier][$figure])) {
            throw new BoardException('Figures stack is empty');
        }

        return array_shift($this->stack[$playerIdentifier][$figure]);
    }

    /**
     * @param string $x
     * @param int    $y
     * @return bool
     */
    protected function isFieldInBoundaries(string $x, int $y): bool
    {
        return in_array($x, $this->width, true) && in_array($y, $this->height, true);
    }
}
