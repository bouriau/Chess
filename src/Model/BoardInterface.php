<?php

declare(strict_types=1);

namespace Chess\Model;

use Chess\Model\Figures\FigureInterface;

interface BoardInterface
{
    /**
     * Return board width (as width elements array)
     *
     * @return array
     */
    public function width() : array;

    /**
     * Return board height (as height elements array)
     *
     * @return array
     */
    public function height() : array;


    /**
     * Get two-dimensional array of board fields
     *
     * @return array
     */
    public function fields() : array;

    /**
     * Get figure that is on given field
     *
     * @param string $x
     * @param int    $y
     * @return FigureInterface|null
     */
    public function get(string $x, int $y): ?FigureInterface;


    /**
     * Places figure on given field
     *
     * @param string $x
     * @param int    $y
     * @param FigureInterface $figure
     */
    public function set(string $x, int $y, FigureInterface $figure);


    /**
     * Remove figure from field
     *
     * @param string $x
     * @param int    $y
     */
    public function remove(string $x, int $y);


    /**
     * Merge fields array with board's fields
     *
     * @param array $fields
     */
    public function merge(array $fields);


    /**
     * Move figure from given field to figures stack
     *
     * @param string $x
     * @param int    $y
     */
    public function stack(string $x, int $y);


    /**
     * Get figure of given class that belongs to a player from stack
     *
     * @param PlayerInterface $player
     * @param string $figure
     *
     * @return FigureInterface
     */
    public function unstack(PlayerInterface $player, string $figure) : FigureInterface;


    /**
     * Create instance of given figure, assign it to given player and place on given field
     *
     * @param string $x
     * @param int    $y
     * @param PlayerInterface $player
     * @param FigureInterface  $figure
     */
    public function add(string $x, int $y, PlayerInterface $player, FigureInterface $figure);
}
