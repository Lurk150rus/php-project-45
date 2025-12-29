<?php

namespace Hexlet\Code;

use function cli\line;
use function cli\prompt;

class Cli
{
    const ANSWERS = ['yes', 'no'];
    const NUMBERS = [15, 6, 7];

    private $name;
    public function greetings()
    {
        line('Welcome to the Brain Game!');
        $this->name = prompt('May I have your name?');
        
        line("Hello, %s!", $this->name);
    }

    public function evenGame()
    {
        line('Answer "yes" if the number is even, otherwise answer "no".');
        foreach (self::NUMBERS as $number) {
            if (self::askAnswer($number) === false) {
                line("Let's try again, %s", $this->name);
                return;
            };
        }

        return line('Congratulations, %s', $this->name);
    }

    private function askAnswer($number)
    {
        $correctAnswer = $number % 2 === 0 ? 'yes' : 'no';

        line('Question: ' . $number);
        $answer = prompt('Your answer');
        if ($answer !== $correctAnswer) {
            line("'$answer' is wrong answer ;(. Correct answer was '$correctAnswer'.");
            return false;
        } else {
            line('Correct!');
            return true;
        }
    }
}
