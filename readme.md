Proof of concept

```php
<?php

// Create chess board
$board = new \Chess\Model\Board();

$playerOneMoves = new \Chess\Manager\MovesManager($board);
$playerTwoMoves = new \Chess\Manager\MovesManager($board);

// Create players
$playerOne = new \Chess\Model\Player($playerOneMoves);
$playerTwo = new \Chess\Model\Player($playerTwoMoves);

// Create players manager
$players = new Chess\PlayerManager($playerOne, $playerTwo)

// Fill board with players' figures
$board->merge(Chess\FieldsFactory::defaultFields($players))

$game = new \Chess\Model\Game($board, $players)

$game->player('whites')->move()->from('b1')->to('a3');
$game->player('whites')->move('na3')

```
