<?php

/**
 * File: Game.php
 *
 * Contains the Game class for brain games.
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
 * Game logic and question generators.
 *
 * @category Game
 * @package  Hexlet\Code
 * @author   Kirill <unknownsomebody@ya.ru>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/Lurk150rus/php-project-45/
 * @since    PHP 8
 */
class Game
{
    /**
     * Summary of game
     *
     * @var string
     */
    private string $_game;

    /**
     * Summary of GAMES
     *
     * @var array
     */
    private const GAMES = [
        'brain-even',
        'brain-calc',
        'brain-gcd',
        'brain-progression',
        'brain-prime'
    ];

    /**
     * Summary of __construct
     *
     * @param string $game - game name
     * 
     * @throws \Exception
     */
    public function __construct(string $game)
    {
        if (!in_array($game, self::GAMES)) {
            throw new \Exception('Unknown game');
        }
        $this->_game = $game;
    }

    /**
     * Summary of createQuestions
     *
     * @throws \Exception
     * @return array
     */
    public function createQuestions(): array
    {
        switch ($this->_game) {
        case 'brain-even':
            return $this->evenQuestions();
        case 'brain-calc':
            return $this->calcQuestions();
        case 'brain-gcd':
            return $this->gcdQuestions();
        case 'brain-progression':
            return $this->progressionQuestions();
        case 'brain-prime':
            return $this->primeQuestions();
        }

        throw new \Exception('Unknown game');
    }

    /**
     * Summary of getLine
     *
     * @throws \Exception
     * @return string
     */
    public function getLine(): string
    {
        switch ($this->_game) {
        case 'brain-even':
            return 'Answer "yes" if the number is even, otherwise answer "no".';
        case 'brain-calc':
            return 'What is the result of the expression?';
        case 'brain-gcd':
            return 'Find the greatest common divisor of given numbers.';
        case 'brain-progression':
            return 'What number is missing in the progression?';
        case 'brain-prime':
            return 'Answer "yes" if given number is prime. Otherwise answer "no".';
        }

        throw new \Exception('Unknown game');
    }

    /**
     * Summary of evenQuestions
     *
     * @return string[]
     */
    public function evenQuestions(): array
    {
        return [15 => 'no', 6 => 'yes', 7 => 'no'];
    }

    /**
     * Summary of calcQuestions
     *
     * @return array{25 * 7: int|string, 25 - 11: int|string, 4 + 10: int|string}
     */
    public function calcQuestions(): array
    {
        return ['4 + 10' => '14', '25 - 11' => '14', '25 * 7' => '175'];
    }

    /**
     * Summary of gcdQuestions
     *
     * @return array{100 52: int|string, 25 50: int|string, 3 9: int|string}
     */
    public function gcdQuestions(): array
    {
        return ['25 50' => '25', '100 52' => '4', '3 9' => '3'];
    }

    /**
     * Summary of progressionQuestions
     *
     * @return array{14 19 24 29 34 39 44 49 54 ..: 
     * int|string, 2 5 8 .. 14 17 20 23 26 29: 
     * int|string, 5 7 9 11 13 .. 17 19 21 23: int|string}
     */
    public function progressionQuestions(): array
    {
        return [
            '5 7 9 11 13 .. 17 19 21 23' => '15',
            '2 5 8 .. 14 17 20 23 26 29' => '11',
            '14 19 24 29 34 39 44 49 54 ..' => '59'
        ];
    }

    /**
     * Summary of primeQuestions
     *
     * @return array{2: string, 3: string, 4: string}
     */
    public function primeQuestions(): array
    {
        return ['2' => 'yes', '3' => 'yes', '4' => 'no'];
    }
}
