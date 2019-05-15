<?php

/**
 * Rolls and get score for game.
 */

namespace App;

/**
 * Class BowlingGame
 *
 * @package App
 */
class BowlingGame
{
    /**
     * @var int
     */
    private $pins;

    /**
     * Roll ball.
     */
    public function roll(int $pins): void
    {
        $this->pins += $pins;
    }

    public function score()
    {
        return $this->pins;
    }
}
