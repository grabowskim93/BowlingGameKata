<?php

/**
 * Single bowling frame.
 */

namespace App;

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
    public function getFrameScore()
    {
        return $this->score;
    }

    public function addPinsToFrame(int $pins): void
    {
        $this->score += $pins;
    }

}
