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
     * Collection of rolls in one game.
     *
     * @var array
     */
    private $rolls = [];

    /**
     * Current roll number.
     *
     * @var int
     */
    private $currentRollNumber = 0;

    /**
     * BowlingGame constructor.
     */
    public function __construct()
    {
        $this->rolls = array_fill(0, 21, 0);
    }

    /**
     * One roll.
     *
     * @param int $pins Number of pins knocked
     */
    public function roll(int $pins): void
    {
        $this->rolls[$this->currentRollNumber] = $pins;
        $this->currentRollNumber++;
    }

    /**
     * Return score of the game.
     *
     * @return int Score of the game
     */
    public function score(): int
    {
        $score = 0;
        $frameIndex = 0;

        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($frameIndex)) {
                $score += $this->rolls[$frameIndex]
                    + $this->rolls[$frameIndex + 1]
                    + $this->rolls[$frameIndex + 2];
                $frameIndex++;
            } elseif ($this->isSpare($frameIndex)) {
                // spare
                $score += $this->rolls[$frameIndex]
                    + $this->rolls[$frameIndex + 1]
                    + $this->rolls[$frameIndex + 2];
                $frameIndex += 2;
            } else {
                $score += $this->rolls[$frameIndex]
                    + $this->rolls[$frameIndex + 1];
                $frameIndex += 2;
            }
        }

        return $score;
    }

    /**
     * Is spare.
     *
     * @param int $frameIndex Frame index
     *
     * @return bool Result
     */
    private function isSpare(int $frameIndex)
    {
        return (10 === $this->rolls[$frameIndex] + $this->rolls[$frameIndex+1]);
    }

    /**
     * Is strike.
     *
     * @param int $frameIndex Frame index
     *
     * @return bool Result
     */
    private function isStrike(int $frameIndex)
    {
        return (10 === $this->rolls[$frameIndex]);
    }
}
