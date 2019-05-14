<?php

/**
 * Single bowling frame.
 */

namespace App;

use DomainException;

/**
 * Class Frame
 *
 * @package App
 */
class Frame
{
    /**
     * @var int
     */
    private $pins;

    /**
     * @var int
     */
    private $score;

    /**
     * Frame constructor.
     */
    public function __construct()
    {
        $this->pins = 0;
    }

    /**
     * Get actual frame score.
     *
     * @return int
     */
    public function getFrameScore(): int
    {
        return $this->score;
    }

    /**
     * Add pins to frame, validate if max pins exceeded.
     *
     * @param Roll $roll
     */
    public function addPinsToFrame(Roll $roll): void
    {
        if ($this->score + $roll->getPins() > BowlingGameDictionary::MAX_PINS) {
            throw new DomainException();
        }
        $this->score += $roll->getPins();
    }

}
