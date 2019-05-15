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
     * Amount of pins required for spare.
     *
     * @var int
     */
    const SPARE_SUM = 10;

    /**
     * Array with all rolls pins.
     *
     * @var array
     */
    private $pins;

    /**
     * Total score of game.
     *
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
        $this->scoreSpare($pins);

        $currentRoll = count($this->pins) - 1; //because increments from 0.

        if (isset($this->pins[$currentRoll-1])
            && $this->pins[$currentRoll-1] === 10
        ) {
            $this->score += $pins;
        }

        if (isset($this->pins[$currentRoll-2])
            && $this->pins[$currentRoll-2] === 10
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

    /**
     * Add extra points if spare.
     *
     * @param int $pins
     */
    private function scoreSpare(int $pins): void
    {
        $currentRoll = count($this->pins) - 1; //because increments from 0.
        if (isset($this->pins[$currentRoll-1])
            && isset($this->pins[$currentRoll-2])
            && $this->pins[$currentRoll-1] + $this->pins[$currentRoll-2] === self::SPARE_SUM
        ) {
            $this->score += $pins;
        }
    }
}
