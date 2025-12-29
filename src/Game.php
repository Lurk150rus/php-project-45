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
 * Validate game name.
 *
 * @param string $game Game identifier
 *
 * @return bool
 */
function is_valid_game(string $game): bool
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
function get_line(string $game): string
{
    if (!is_valid_game($game)) {
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
 * @return array<string,string>
 */
function create_questions(string $game): array
{
    if (!is_valid_game($game)) {
        throw new \InvalidArgumentException('Unknown game: ' . $game);
    }

    return match ($game) {
        'brain-even' => even_questions(),
        'brain-calc' => calc_questions(),
        'brain-gcd' => gcd_questions(),
        'brain-progression' => progression_questions(),
        'brain-prime' => prime_questions(),
        default => throw new \InvalidArgumentException('Unknown game: ' . $game),
    };
}

/**
 * Even questions generator (pure).
 *
 * @return array<string,string>
 */
function even_questions(): array
{
    return ['15' => 'no', '6' => 'yes', '7' => 'no'];
}

/**
 * Calc questions generator (pure).
 *
 * @return array<string,string>
 */
function calc_questions(): array
{
    return ['4 + 10' => '14', '25 - 11' => '14', '25 * 7' => '175'];
}

/**
 * GCD questions generator (pure).
 *
 * @return array<string,string>
 */
function gcd_questions(): array
{
    return ['25 50' => '25', '100 52' => '4', '3 9' => '3'];
}

/**
 * Progression questions generator (pure).
 *
 * @return array<string,string>
 */
function progression_questions(): array
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
 * @return array<string,string>
 */
function prime_questions(): array
{
    return ['2' => 'yes', '3' => 'yes', '4' => 'no'];
}
