<?php

/**
 * Rolls and get score for game.
 */

namespace App;

use InvalidArgumentException;

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
    const MAX_PINS = 10;

    /**
     * @var int
     */
    const MIN_PINS = 0;

    /**
     * @var int
     */
    private $score;

    /**
     * BowlingGame constructor.
     */
    public function __construct()
    {
    }

    /**
     * Single bowling roll.

     * @param int $pins
     */
    public function roll(int $pins): void
    {
        if ($pins > self::MAX_PINS || $pins < self::MIN_PINS) {
            throw new InvalidArgumentException();
        }
        $this->score += $pins;
    }

    /**
     * Get bowling game score.
     *
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }
}
