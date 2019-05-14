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
    }
}