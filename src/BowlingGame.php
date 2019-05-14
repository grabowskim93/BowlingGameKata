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
    const MIN_PINS = 0;

    /**
     * @var int
     */
    private $score;

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
        $this->currentFrame = new Frame();
        $this->frames[] = $this->currentFrame;
    }

    /**
     * Single bowling roll.

     * @param int $pins
     */
    public function roll(int $pins): void
    {
        if ($pins > BowlingGameDictionary::MAX_PINS || $pins < self::MIN_PINS) {
            throw new InvalidArgumentException();
        }

        $this->currentFrame->addPinsToFrame($pins);

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
