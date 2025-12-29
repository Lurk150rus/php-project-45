<?php

namespace Hexlet\Code;

use Hexlet\Code\Game;

use function cli\line;
use function cli\prompt;

class Cli
{
    private $name, $game, $questions, $initLine;

    public function __construct($game = null)
    {
        $this->game = $game ? new Game($game) : null;
    }
    public function greetings()
    {
        line('Welcome to the Brain Games!');
        $this->name = prompt('May I have your name?');

        line("Hello, %s!", $this->name);
    }

    public function start()
    {
        $this->greetings();
        $this->questions = $this->game->createQuestions();
        $this->initLine = $this->game->getLine();
        $this->play();
    }

    public function play()
    {
        line($this->initLine);
        foreach ($this->questions as $question => $correctAnswer) {
            if (self::askAnswer($question, $correctAnswer) === false) {
                line("Let's try again, %s", $this->name);
                return;
            };
        }

        return line('Congratulations, %s!', $this->name);
    }

    private function askAnswer($question, $correctAnswer)
    {
        line('Question: ' . $question);
        $answer = prompt('Your answer');
        if ($answer != $correctAnswer) {
            line("'$answer' is wrong answer ;(. Correct answer was '$correctAnswer'.");
            return false;
        } else {
            line('Correct!');
            return true;
        }
    }
}
