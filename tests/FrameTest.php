<?php

namespace Test;

use App\Frame;
use App\Roll;
use DomainException;
use PHPUnit\Framework\TestCase;

class FrameTest extends TestCase
{
    /**
     * @dataProvider framePinsProvider
     *
     * @param $input
     * @param $output
     * @param $expectException
     */
    public function testFrameScore($input, $output, $expectException)
    {
        $frame = new Frame();

        if ($expectException) {
            $this->expectException($expectException);
        }
        foreach ($input as $item) {
            $frame->addRollToFrame(new Roll($item));
        }
        $this->assertEquals($output, $frame->getFrameScore());
    }

    public function testIfCreateFrame()
    {
        $frame = new Frame();
        $frame->addRollToFrame(new Roll(1));
        $frame->addRollToFrame(new Roll(2));
        $this->assertTrue($frame->whetherCreateFrame());

        $frame = new Frame();
        $frame->addRollToFrame(new Roll(1));
        $this->assertFalse($frame->whetherCreateFrame());
    }

    public function testisFrameStrike()
    {
        $frame = new Frame();
        $frame->addRollToFrame(new Roll(10));
        $this->assertTrue($frame->isStrike());

        $frame = new Frame();
        $frame->addRollToFrame(new Roll(0));
        $frame->addRollToFrame(new Roll(10));
        $this->assertFalse($frame->isStrike());

        $frame = new Frame();
        $frame->addRollToFrame(new Roll(8));
        $this->assertFalse($frame->isStrike());
    }

    public function testAddPinsToFrame()
    {
        $frame = new Frame();
        $frame->addPinsToFrame(4);
        $this->assertEquals(4, $frame->getFrameScore());
    }

    public function framePinsProvider()
    {
        yield 'Frame #1' => ['input' => [10], 'output' => 10, 'expectException' => false];
        yield 'Frame #2' => ['input' => [10, 10], 'output' => null, 'expectException' => DomainException::class];
    }
}
