<?php

namespace Test;

use App\BowlingGame;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    public function testRoll()
    {
        $bowlingGame = new BowlingGame();
        $this->assertInstanceOf(BowlingGame::class, $bowlingGame);

        $bowlingGame->roll(5);
        $this->assertEquals(5, $bowlingGame->getScore());
    }
}
