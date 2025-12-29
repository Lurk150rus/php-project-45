<?php

namespace Hexlet\Code;

class Game
{
    private $game;

    const GAMES = ['brain-even', 'brain-calc'];

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
        }

        throw new \Exception('Unknown game');
    }

    public function getLine(): string{
        switch ($this->game) {
            case 'brain-even':
                return 'Answer "yes" if the number is even, otherwise answer "no".';
            case 'brain-calc':
                return 'What is the result of the expression?';
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
}
