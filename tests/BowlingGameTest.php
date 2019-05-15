<?php

/**
 * Test bowling game.
 */

namespace Test;

use App\BowlingGame;
use Generator;
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
     *
     * @dataProvider rollsProvider
     *
     * @param $input
     * @param $output
     * @param $expectException
     */
    public function testRoll($input, $output, $expectException)
    {
        $bowlingGame = new BowlingGame();

        foreach ($input as $roll) {
            $bowlingGame->roll($roll);
        }

        $this->assertEquals($output, $bowlingGame->score());
    }

    /**
     * Input - rolls in bowling game.
     * Output - score after game.
     * ExpectedError - determines if non valid game.
     *
     * @return Generator
     */
    public function rollsProvider()
    {
        yield 'Game#1 - all ones'   => [
            'input' => [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            'output' => 20, 'expectError' => false
        ];
        yield 'Game#2 - spare in first frame'  => [
            'input' => [6, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'output' => 16, 'expectError' => false
        ];
        yield 'Game#3 - strike in first frame, followed by 3 and 4 pins, followed by all misses'  => [
            'input' => [10, 3, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'output' => 24, 'expectError' => false
        ];
        yield 'Game#4 - perfect game - 12 strikes'  => [
            'input' => [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10],
            'output' => 300, 'expectError' => false
        ];
        yield 'Game#5 - 2 strikes followed by spare'  => [
            'input' => [10, 10, 7, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'output' => 57, 'expectError' => false
        ];
    }
}
