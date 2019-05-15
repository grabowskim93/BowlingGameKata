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
     * Amount of pins required for strike.
     *
     * @var int
     */
    const STRIKE_SUM = 10;

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

    /**
     * @var array
     */
    private $currentFrame;

    /**
     * @var array
     */
    private $frames;

    public function __construct()
    {
        $this->score = 0;
        $this->pins = [];
        $this->currentFrame = [];
        $this->frames = [];
    }

    /**
     * Roll ball.
     *
     * @param int $pins
     */
    public function roll(int $pins): void
    {
        if (count($this->frames) <= 10) {
            $this->score += $pins;
        }

        if ($pins === self::STRIKE_SUM) {
            $this->currentFrame = [$pins];
            $this->frames[] = $this->currentFrame;
            $this->pins = [];
            $this->scoreSpare();
            $this->scoreStrike();
        } elseif ((count($this->pins) === 1)) {
            $this->currentFrame = [$this->pins[0], $pins];
            $this->frames[] = $this->currentFrame;
            $this->pins = [];
            $this->scoreSpare();
            $this->scoreStrike();
        } else {
            $this->pins[] = $pins;
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
     */
    private function scoreSpare(): void
    {
        $currentFrame = count($this->frames) - 1; //because increments from 0.
        if (isset($this->frames[$currentFrame-1])
            && count($this->frames[$currentFrame-1]) === 2
            && array_sum($this->frames[$currentFrame-1]) === self::SPARE_SUM
        ) {
            $this->score += $this->currentFrame[0];
        }
    }

    /**
     * Add extra points if strike.
     */
    private function scoreStrike(): void
    {
        $currentFrame = count($this->frames) - 1; //because increments from 0.
        if (isset($this->frames[$currentFrame-1])
            && count($this->frames) < 12
            && $this->frames[$currentFrame-1][0] === 10
        ) {
            $this->score += array_sum($this->currentFrame);
        }

        if (isset($this->frames[$currentFrame-2])
            && count($this->frames) < 12
            && $this->frames[$currentFrame-2][0] === 10
        ) {
            $this->score += array_sum($this->currentFrame);
        }
    }
}
