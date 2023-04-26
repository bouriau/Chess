<?php

use JetBrains\PhpStorm\NoReturn;

require 'vendor/autoload.php';

#[NoReturn] function dd(): void
{
    call_user_func_array('dump', func_get_args());
    die();
}

// Initialize board
$board = new Chess\Board();

// Initialize board moves manager
$movesFactory = new Chess\MovesManagerFactory($board);
$playerFactory = new Chess\PlayerFactory($movesFactory);

// Create players
$playerOne = $playerFactory->make();
$playerTwo = $playerFactory->make();

// Create players manager
$players = new Chess\PlayersManager($playerOne, $playerTwo);

// Initialize figures
try {
    $board->add('a', 1, $playerOne, Chess\Figures\Rook::class);
    $board->add('b', 1, $playerOne, Chess\Figures\Knight::class);
    $board->add('c', 1, $playerOne, Chess\Figures\Bishop::class);
    $board->add('d', 1, $playerOne, Chess\Figures\King::class);
    $board->add('e', 1, $playerOne, Chess\Figures\Queen::class);
    $board->add('f', 1, $playerOne, Chess\Figures\Bishop::class);
    $board->add('g', 1, $playerOne, Chess\Figures\Knight::class);
    $board->add('h', 1, $playerOne, Chess\Figures\Rook::class);

    $board->add('a', 2, $playerOne, Chess\Figures\Pawn::class);
    $board->add('b', 2, $playerOne, Chess\Figures\Pawn::class);
    $board->add('c', 2, $playerOne, Chess\Figures\Pawn::class);
    $board->add('d', 2, $playerOne, Chess\Figures\Pawn::class);
    $board->add('e', 2, $playerOne, Chess\Figures\Pawn::class);
    $board->add('f', 2, $playerOne, Chess\Figures\Pawn::class);
    $board->add('g', 2, $playerOne, Chess\Figures\Pawn::class);
    $board->add('h', 2, $playerOne, Chess\Figures\Pawn::class);

    $board->add('a', 8, $playerTwo, Chess\Figures\Rook::class);
    $board->add('b', 8, $playerTwo, Chess\Figures\Knight::class);
    $board->add('c', 8, $playerTwo, Chess\Figures\Bishop::class);
    $board->add('d', 8, $playerTwo, Chess\Figures\King::class);
    $board->add('e', 8, $playerTwo, Chess\Figures\Queen::class);
    $board->add('f', 8, $playerTwo, Chess\Figures\Bishop::class);
    $board->add('g', 8, $playerTwo, Chess\Figures\Knight::class);
    $board->add('h', 8, $playerTwo, Chess\Figures\Rook::class);

    $board->add('a', 7, $playerTwo, Chess\Figures\Pawn::class);
    $board->add('b', 7, $playerTwo, Chess\Figures\Pawn::class);
    $board->add('c', 7, $playerTwo, Chess\Figures\Pawn::class);
    $board->add('d', 7, $playerTwo, Chess\Figures\Pawn::class);
    $board->add('e', 7, $playerTwo, Chess\Figures\Pawn::class);
    $board->add('f', 7, $playerTwo, Chess\Figures\Pawn::class);
    $board->add('g', 7, $playerTwo, Chess\Figures\Pawn::class);
    $board->add('h', 7, $playerTwo, Chess\Figures\Pawn::class);
} catch (\Chess\Exceptions\BoardException|ReflectionException $e) {

}

// Create game
$game = new Chess\Game($board, $players);

//dd($game->player('whites'));
$game->player('whites')->move()->from('e2')->to('e4');
$game->player('whites')->move()->from('e1')->to('e3');

dd($game);
