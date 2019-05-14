<?php

/**
 * Single bowling roll.
 */

namespace App;

/**
 * Class Roll
 *
 * @package App
 */
class Roll
{
    /**
     * @var int
     */
    private $pins;

    /**
     * Roll constructor.
     *
     * @param int $pins
     */
    public function __construct(int $pins)
    {
        $this->pins = $pins;
    }

    /**
     * Get roll pins.
     *
     * @return int
     */
    public function getPins()
    {
        return $this->pins;
    }
}
