<?php

declare(strict_types=1);

namespace Chess\Controller;

use Chess\Exceptions\BoardException;
use Chess\Factory\MovesManagerFactory;
use Chess\Factory\PlayerFactory;
use Chess\Manager\PlayersManager;
use Chess\Model\Board;
use Chess\Model\Figures\Bishop;
use Chess\Model\Figures\King;
use Chess\Model\Figures\Knight;
use Chess\Model\Figures\Pawn;
use Chess\Model\Figures\Queen;
use Chess\Model\Figures\Rook;
use Chess\Model\Game;
use ReflectionException;

class ChessController
{
    public function index(): void
    {
        // Initialize board
        $board = new Board();

        // Initialize board moves manager
        $movesFactory = new MovesManagerFactory($board);
        $playerFactory = new PlayerFactory($movesFactory);

        // Create players
        $playerOne = $playerFactory->make();
        $playerTwo = $playerFactory->make();

        // Create players manager
        $players = new PlayersManager($playerOne, $playerTwo);

        // Initialize figures
        try {
            $board->add('a', 1, $playerOne, Rook::class);
            $board->add('b', 1, $playerOne, Knight::class);
            $board->add('c', 1, $playerOne, Bishop::class);
            $board->add('d', 1, $playerOne, King::class);
            $board->add('e', 1, $playerOne, Queen::class);
            $board->add('f', 1, $playerOne, Bishop::class);
            $board->add('g', 1, $playerOne, Knight::class);
            $board->add('h', 1, $playerOne, Rook::class);

            $board->add('a', 2, $playerOne, Pawn::class);
            $board->add('b', 2, $playerOne, Pawn::class);
            $board->add('c', 2, $playerOne, Pawn::class);
            $board->add('d', 2, $playerOne, Pawn::class);
            $board->add('e', 2, $playerOne, Pawn::class);
            $board->add('f', 2, $playerOne, Pawn::class);
            $board->add('g', 2, $playerOne, Pawn::class);
            $board->add('h', 2, $playerOne, Pawn::class);

            $board->add('a', 8, $playerTwo, Rook::class);
            $board->add('b', 8, $playerTwo, Knight::class);
            $board->add('c', 8, $playerTwo, Bishop::class);
            $board->add('d', 8, $playerTwo, King::class);
            $board->add('e', 8, $playerTwo, Queen::class);
            $board->add('f', 8, $playerTwo, Bishop::class);
            $board->add('g', 8, $playerTwo, Knight::class);
            $board->add('h', 8, $playerTwo, Rook::class);

            $board->add('a', 7, $playerTwo, Pawn::class);
            $board->add('b', 7, $playerTwo, Pawn::class);
            $board->add('c', 7, $playerTwo, Pawn::class);
            $board->add('d', 7, $playerTwo, Pawn::class);
            $board->add('e', 7, $playerTwo, Pawn::class);
            $board->add('f', 7, $playerTwo, Pawn::class);
            $board->add('g', 7, $playerTwo, Pawn::class);
            $board->add('h', 7, $playerTwo, Pawn::class);
        } catch (BoardException|ReflectionException $e) {

        }

        // Create game
        $game = new Game($board, $players);

        //dd($game->player('whites'));
        $game->player('whites')->move()->from('e2')->to('e4');
        $game->player('whites')->move()->from('e1')->to('e3');

        dd($game);
    }
}