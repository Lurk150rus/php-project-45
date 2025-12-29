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
 * Generate GCD questions (pure functional).
 *
 * @param int $count Number of questions
 * @param int $maxValue Maximum value of numbers
 * @return array<string,string>
 */
function gcdQuestions(int $count = 3, int $maxValue = 100): array
{
    $questions = [];

    while (count($questions) < $count) {
        $a = random_int(1, $maxValue);
        $b = random_int(1, $maxValue);
        $key = "$a $b";
        $questions[$key] = (string) gcd($a, $b);
    }

    return $questions;
}

/**
 * Helper: compute GCD of two numbers.
 */
function gcd(int $a, int $b): int
{
    return $b === 0 ? $a : gcd($b, $a % $b);
}


/**
 * Generate arithmetic progression questions (pure functional).
 *
 * @param int $count Number of questions
 * @param int $length Length of progression
 * @param int $stepMax Maximum step between numbers
 * @param int $startMax Maximum start number
 * @return array<string,string>
 */
function progressionQuestions(int $count = 3, int $length = 10, int $stepMax = 10, int $startMax = 50): array
{
    $questions = [];

    while (count($questions) < $count) {
        $start = random_int(1, $startMax);
        $step = random_int(1, $stepMax);
        $missingIndex = random_int(0, $length - 1);

        $progression = [];
        for ($i = 0; $i < $length; $i++) {
            $progression[] = $start + $i * $step;
        }

        $answer = (string)$progression[$missingIndex];
        $progression[$missingIndex] = '..';
        $key = implode(' ', $progression);
        $questions[$key] = $answer;
    }

    return $questions;
}

/**
 * Generate prime number questions (pure functional).
 *
 * @param int $count Number of questions
 * @param int $max Maximum value for primes
 * @return array<int|string,string>
 */
function primeQuestions(int $count = 3, int $max = 50): array
{
    $questions = [];

    while (count($questions) < $count) {
        $num = random_int(2, $max);
        if (!isset($questions[(string)$num])) {
            $questions[(string)$num] = isPrime($num) ? 'yes' : 'no';
        }
    }

    return $questions;
}

/**
 * Summary of Hexlet\Code\isPrime
 * @param int $n
 * @return bool
 */
function isPrime(int $n): bool
{
    if ($n < 2) {
        return false;
    }
    for ($i = 2; $i * $i <= $n; $i++) {
        if ($n % $i === 0) {
            return false;
        }
    }
    return true;
}
