<?php

/**
 * File: Game.php
 *
 * Functional API for game logic and question generators.
 *
 * @category Game
 * @package  Hexlet\Code
 * @author   Kirill <unknownsomebody@ya.ru>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/Lurk150rus/php-project-45/
 * @since    PHP 8
 */

namespace Hexlet\Code;

/**
 * List of supported games.
 *
 * @var array
 */
const GAMES = [
    'brain-even',
    'brain-calc',
    'brain-gcd',
    'brain-progression',
    'brain-prime',
];

/**
 * Summary of GAME_COUNT
 * @var int
 */
const GAME_COUNT = 3;

/**
 * Validate game name.
 *
 * @param string $game Game identifier
 *
 * @return bool
 */
function isValidGame(string $game): bool
{
    return in_array($game, GAMES, true);
}

/**
 * Return description / question prompt for the given game.
 *
 * Pure function — no side effects.
 *
 * @param string $game Game identifier
 *
 * @throws \InvalidArgumentException When game is unknown
 * @return string
 */
function getLine(string $game): string
{
    if (!isValidGame($game)) {
        throw new \InvalidArgumentException('Unknown game: ' . $game);
    }

    return match ($game) {
        'brain-even' => 'Answer "yes" if the number is even, otherwise answer "no".',
        'brain-calc' => 'What is the result of the expression?',
        'brain-gcd' => 'Find the greatest common divisor of given numbers.',
        'brain-progression' => 'What number is missing in the progression?',
        'brain-prime' => 'Answer "yes" if given number is prime. Otherwise answer "no".',
        default => throw new \InvalidArgumentException('Unknown game: ' . $game),
    };
}

/**
 * Return questions for the given game.
 *
 * Pure function — no side effects.
 *
 * @param string $game Game identifier
 *
 * @throws \InvalidArgumentException When game is unknown
 * @return array
 */
function createQuestions(string $game): array
{
    if (!isValidGame($game)) {
        throw new \InvalidArgumentException('Unknown game: ' . $game);
    }

    return match ($game) {
        'brain-even' => evenQuestions(),
        'brain-calc' => calcQuestions(),
        'brain-gcd' => gcdQuestions(),
        'brain-progression' => progressionQuestions(),
        'brain-prime' => primeQuestions(),
        default => throw new \InvalidArgumentException('Unknown game: ' . $game),
    };
}

/**
 * Even questions generator (pure).
 *
 * @return array<int,string>
 */
function evenQuestions(): array
{
    $questions = [];
    for ($i = 0; $i < GAME_COUNT; $i++) {
        $key = random_int(1, 3000);
        $questions[$key] = $key % 2 === 0 ? 'yes' : 'no';
    }
    return $questions;
}

/**
 * Calc questions generator (pure).
 *
 * @return array<string,string>
 */
function calcQuestions(): array
{
    $operations = ['+', '-', '*'];

    $questions = [];

    for ($i = 0; $i < GAME_COUNT; $i++) {
        $operandFirst = random_int(1, 3000);
        $operandSecond = random_int(1, 3000);
        $operation = $operations[random_int(0, 2)];

        $key = "$operandFirst $operation $operandSecond";

        $result = match ($operation) {
            '+' => $operandFirst + $operandSecond,
            '-' => $operandFirst - $operandSecond,
            '*' => $operandFirst * $operandSecond,
        };

        $questions[$key] = (string) $result;
    }

    return $questions;
}

/**
 * GCD questions generator (pure).
 *
 * @return array<string,string>
 */
function gcdQuestions(): array
{
    return ['25 50' => '25', '100 52' => '4', '3 9' => '3'];
}

/**
 * Progression questions generator (pure).
 *
 * @return array<string, string>
 */
function progressionQuestions(): array
{
    return [
        '5 7 9 11 13 .. 17 19 21 23' => '15',
        '2 5 8 .. 14 17 20 23 26 29' => '11',
        '14 19 24 29 34 39 44 49 54 ..' => '59',
    ];
}

/**
 * Prime questions generator (pure).
 *
 * @return array<int,string>
 */
function primeQuestions(): array
{
    return ['2' => 'yes', '3' => 'yes', '4' => 'no'];
}
