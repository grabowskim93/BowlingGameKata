<?php

/**
 * Test bowling game.
 */

namespace Test;

use App\BowlingGame;
use PHPUnit\Framework\TestCase;

/**
 * Class BowlingGameTest
 *
 * @package Test
 */
class BowlingGameTest extends TestCase
{
    /**
     * Test bowling roll.
     */
    public function testRoll()
    {
        $bowlingGame = new BowlingGame();
        $bowlingGame->roll();

        $this->assertTrue(true);
    }
}
