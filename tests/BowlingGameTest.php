<?php

namespace Test;

use App\BowlingGame;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    /**
     * @dataProvider rollProvider
     *
     * @param $input
     * @param $output
     * @param $expectException
     */
    public function testRoll($input, $output, $expectException)
    {
        $bowlingGame = new BowlingGame();
        $this->assertInstanceOf(BowlingGame::class, $bowlingGame);

        if ($expectException) {
            $this->expectException($expectException);
        }
        foreach ($input as $item) {
            $bowlingGame->roll($item);
        }
        $this->assertEquals($output, $bowlingGame->getScore());
    }

    public function rollProvider()
    {
        yield 'Valid data#1' => ['input' => [5, 5], 'output' => 10, 'expectException' => false];
        yield 'Valid data#2' => ['input' => [10], 'output' => 10, 'expectException' => false];
        yield 'Valid data#3' => ['input' => [0], 'output' => 0, 'expectException' => false];
        yield 'Valid data#4' => ['input' => [6, 5], 'output' => null, 'expectException' => \DomainException::class];
        yield 'Invalid data#1' => [
            'input' => [11], 'output' => null, 'expectException' => InvalidArgumentException::class
        ];
        yield 'Invalid data#2' => [
            'input' => [-1], 'output' => null, 'expectException' => InvalidArgumentException::class
        ];
    }
}
