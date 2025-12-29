<?php

namespace Hexlet\Code;

class Game
{
    private $game;

    const GAMES = ['brain-even', 'brain-calc', 'brain-gcd', 'brain-progression', 'brain-prime'];

    public function __construct($game)
    {
        if(!in_array($game, self::GAMES)){
            throw new \Exception('Unknown game');
        }
        $this->game = $game;
    }

    public function createQuestions(): array
    {
        switch ($this->game) {
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

    public function getLine(): string{
        switch ($this->game) {
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
    public function evenQuestions(): array
    {
        return [15 => 'no', 6 => 'yes', 7 => 'no'];
    }
    public function calcQuestions(): array
    {
        return ['4 + 10' => '14', '25 - 11' => '14', '25 * 7' => '175'];
    }

    public function gcdQuestions(): array
    {
        return ['25 50' => '25', '100 52' => '4', '3 9' => '3'];
    }

    public function progressionQuestions(): array
    {
        return ['5 7 9 11 13 .. 17 19 21 23' => '15', '2 5 8 .. 14 17 20 23 26 29' => '11', '14 19 24 29 34 39 44 49 54 ..' => '59'];
    }

    public function primeQuestions(): array
    {
        return ['2' => 'yes', '3' => 'yes', '4' => 'no'];
    }
}
