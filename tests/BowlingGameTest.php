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
     * @param $pins
     * @param $score
     */
    public function testGame($pins, $score)
    {
        $bowlingGame = new BowlingGame();

        foreach ($pins as $pin) {
            $bowlingGame->roll($pin);
        }
        $this->assertEquals($score, $bowlingGame->score());
    }

    /**
     * @return \Generator
     */
    public function rollsProvider()
    {
        yield 'all ones'  => [
            'input' => [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            'output' => 20
        ];

        yield 'one and two'  => [
            'input' => [2, 1, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2],
            'output' => 24
        ];

        yield 'first spare'  => [
            'input' => [6, 4, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'output' => 20
        ];

        yield 'first strike'  => [
            'input' => [10, 4, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'output' => 28
        ];

        yield 'perfect game'  => [
            'input' => [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10],
            'output' => 300
        ];

        yield 'first spare rest strikes'  => [
            'input' => [0, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10],
            'output' => 290
        ];

        yield 'last spare '  => [
            'input' => [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 1],
            'output' => 291
        ];
    }
}
