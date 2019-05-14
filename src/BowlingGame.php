<?php

/**
 * Rolls and get score for game.
 */

namespace App;

use DomainException;
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
     * @var int
     */
    private $previous;

    /**
     * @var array
     */
    private $frames;

    /**
     * @var Frame
     */
    private $currentFrame;

    /**
     * BowlingGame constructor.
     */
    public function __construct()
    {
        $this->previous = 0;
        $this->currentFrame = new Frame();
        $this->frames[] = $this->currentFrame;
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

        if ($this->previous + $pins > self::MAX_PINS) {
            throw new DomainException();
        }

        $this->previous = $pins;

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
