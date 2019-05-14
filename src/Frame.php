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
     * @var array
     */
    private $rolls;

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
    public function addRoleToFrame(Roll $roll): void
    {
        if ($this->score + $roll->getPins() > BowlingGameDictionary::MAX_PINS) {
            throw new DomainException();
        }
        $this->rolls[] = $roll;
        $this->score += $roll->getPins();
    }

}
