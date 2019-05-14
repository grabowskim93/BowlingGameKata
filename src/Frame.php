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
        return 10;
    }

}
