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
     * @var Roll
     */
    private $roll;

    /**
     * Frame constructor.
     */
    public function __construct()
    {
        $this->pins = 0;
        $this->rolls = [];
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
        $this->roll = $roll;
        $this->score += $roll->getPins();
    }

    /**
     * Whether must create new frame.
     *
     * @return bool
     */
    public function whetherCreateFrame(): bool
    {
        if (count($this->rolls) == 2) {
            return true;
        }

        return false;
    }

    /**
     * Whether frame is strike
     *
     * @return bool
     */
    public function isStrike(): bool
    {
        if (count($this->rolls) === 1 && $this->roll->getPins() === 10) {
            return true;
        }

        return false;
    }
}
