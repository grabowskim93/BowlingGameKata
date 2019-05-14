<?php

/**
 * Single bowling roll.
 */

namespace App;

use InvalidArgumentException;

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
        if ($pins > BowlingGameDictionary::MAX_PINS || $pins < BowlingGame::MIN_PINS) {
            throw new InvalidArgumentException();
        }

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
