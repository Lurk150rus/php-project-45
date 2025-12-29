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
    private string $_name;
    /**
     * Summary of game
     *
     * @var ?Game
     */
    private ?Game $_game;
    /**
     * Summary of questions
     *
     * @var array
     */
    private array $_questions;
    /**
     * Summary of initLine
     *
     * @var string
     */
    private string $_initLine;

    /**
     * Initialize the CLI with optional game.
     *
     * @param string|null $game Game name to initialize, or null for none
     */
    public function __construct(?string $game = null)
    {
        $this->_game = $game ? new Game($game) : null;
    }

    /**
     * Summary of greetings
     *
     * @return void
     */
    public function greetings(): void
    {
        line('Welcome to the Brain Games!');
        $this->_name = prompt('May I have your name?');

        line("Hello, %s!", $this->_name);
    }

    /**
     * Summary of start
     *
     * @return void
     */
    public function start(): void
    {
        $this->greetings();
        $this->_questions = $this->_game->createQuestions();
        $this->_initLine = $this->_game->getLine();
        $this->play();
    }

    /**
     * Summary of play
     *
     * @return void
     */
    public function play(): void
    {
        line($this->_initLine);
        foreach ($this->_questions as $question => $correctAnswer) {
            if (self::_askAnswer($question, $correctAnswer) === false) {
                line("Let's try again, %s!", $this->_name);
                return;
            };
        }

        line('Congratulations, %s!', $this->_name);
    }

    /**
     * Ask the user a question and check the answer.
     *
     * @param mixed $question      The question to ask
     * @param mixed $correctAnswer Correct answer to compare against
     * 
     * @return bool True if answer is correct, false otherwise
     */
    private function _askAnswer($question, $correctAnswer): bool
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
