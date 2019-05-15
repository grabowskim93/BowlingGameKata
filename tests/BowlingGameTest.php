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

        $rolls = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
        foreach ($rolls as $roll) {
            $bowlingGame->roll($roll);
        }

        $this->assertEquals(20, $bowlingGame->score());
    }
}
