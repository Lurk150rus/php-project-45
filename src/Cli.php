<?php

/**
 * File: Cli.php
 *
 * Contains the CLI class for Brain Games.
 *
 * @category Cli
 * @package  Hexlet\Code
 * @author   Kirill <unknownsomebody@ya.ru>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/Lurk150rus/php-project-45/
 * @since    PHP 8
 */

namespace Hexlet\Code;

use Hexlet\Code\Game;

use function cli\line;
use function cli\prompt;

/**
 * Summary of Cli
 *
 * @category Cli
 * @package  Hexlet\Code
 * @author   Kirill <unknownsomebody@ya.ru>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/Lurk150rus/php-project-45/
 * @since    PHP 8
 */
class Cli
{
    /**
     * Summary of name
     *
     * @var string
     */
    private string $name;
    /**
     * Summary of game
     *
     * @var ?Game
     */
    private ?Game $game;
    /**
     * Summary of questions
     *
     * @var array
     */
    private array $questions;
    /**
     * Summary of initLine
     *
     * @var string
     */
    private string $initLine;

    /**
     * Initialize the CLI with optional game.
     *
     * @param string|null $game Game name to initialize, or null for none
     */
    public function __construct(?string $game = null)
    {
        $this->game = $game ? new Game($game) : null;
    }

    /**
     * Summary of greetings
     *
     * @return void
     */
    public function greetings(): void
    {
        line('Welcome to the Brain Games!');
        $this->name = prompt('May I have your name?');

        line("Hello, %s!", $this->name);
    }

    /**
     * Summary of start
     *
     * @return void
     */
    public function start(): void
    {
        $this->greetings();
        $this->questions = $this->game->createQuestions();
        $this->initLine = $this->game->getLine();
        $this->play();
    }

    /**
     * Summary of play
     *
     * @return void
     */
    public function play(): void
    {
        line($this->initLine);
        foreach ($this->questions as $question => $correctAnswer) {
            if (self::askAnswer($question, $correctAnswer) === false) {
                line("Let's try again, %s!", $this->name);
                return;
            };
        }

        line('Congratulations, %s!', $this->name);
    }

    /**
     * Ask the user a question and check the answer.
     *
     * @param mixed $question      The question to ask
     * @param mixed $correctAnswer Correct answer to compare against
     *
     * @return bool True if answer is correct, false otherwise
     */
    private function askAnswer($question, $correctAnswer): bool
    {
        line('Question: ' . $question);
        $answer = prompt('Your answer');
        if ($answer != $correctAnswer) {
            line(
                "'$answer' is wrong answer ;(. 
            Correct answer was '$correctAnswer'."
            );
            return false;
        } else {
            line('Correct!');
            return true;
        }
    }
}
