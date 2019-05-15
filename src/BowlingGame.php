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
     * @var array
     */
    private $pins;

    /**
     * @var int
     */
    private $score;

    public function __construct()
    {
        $this->score = 0;
        $this->pins = [];
    }

    /**
     * Roll ball.
     *
     * @param int $pins
     */
    public function roll(int $pins): void
    {
        $this->score += $pins;

        $this->pins[] = $pins;

        $currentRoll = count($this->pins) - 1; //because increments from 0.
        if (isset($this->pins[$currentRoll-1])
            && isset($this->pins[$currentRoll-2])
            && $this->pins[$currentRoll-1] + $this->pins[$currentRoll-2] === 10
        ) {
            $this->score += $pins;
        }
    }

    /**
     * Get sum of pins after rolls.
     *
     * @return int
     */
    public function score(): int
    {
        return $this->score;
    }
}
