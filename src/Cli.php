<?php

/**
 * File: Cli.php
 *
 * Functional CLI helpers for Brain Games.
 *
 * @category Cli
 * @package  Hexlet\Code
 * @author   Kirill <unknownsomebody@ya.ru>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/Lurk150rus/php-project-45/
 * @since    PHP 8
 */

namespace Hexlet\Code;

use function cli\line;
use function cli\prompt;

/**
 * Greet the user and return their name.
 *
 * Side effect: prompts user.
 *
 * @return string User name
 */
function greetings(): string
{
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);

    return $name;
}

/**
 * Ask one question, print feedback and return whether it was correct.
 *
 * Side effects: uses prompt() and line().
 *
 * @param string $question      Question text
 * @param string $correctAnswer Correct answer
 *
 * @return bool
 */
function askAnswer(string $question, string $correctAnswer): bool
{
    line('Question: ' . $question);
    $answer = prompt('Your answer');

    if ($answer !== $correctAnswer) {
        line(sprintf("'%s' is wrong answer ;(.", $answer));
        line(sprintf("Correct answer was '%s'.", $correctAnswer));
        return false;
    }

    line('Correct!');
    return true;
}

/**
 * Run the CLI flow for given game.
 *
 * @param string|null $gameName Game identifier or null to fail
 *
 * @throws \InvalidArgumentException
 * @return void
 */
function runCli(?string $gameName = null): void
{
    if ($gameName === null) {
        throw new \InvalidArgumentException('Game name is required');
    }
    if (!isValidGame($gameName)) {
        throw new \InvalidArgumentException('Unknown game: ' . $gameName);
    }

    $name = greetings();
    $questions = createQuestions($gameName);
    $initLine = getLine($gameName);

    line($initLine);
    foreach ($questions as $question => $correctAnswer) {
        $ok = askAnswer((string) $question, (string) $correctAnswer);
        if ($ok === false) {
            line("Let's try again, %s!", $name);
            return;
        }
    }

    line('Congratulations, %s!', $name);
}
