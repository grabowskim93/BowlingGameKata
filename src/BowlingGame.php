<?php

/**
 * Rolls and get score for game.
 */

namespace App;

/**
 * Class BowlingGame
 *
 * @package App
 */
class BowlingGame
{
    /**
     * BowlingGame constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param int $pins
     *
     * @return int
     */
    public function roll(int $pins): int
    {
        return $pins;
    }
}
