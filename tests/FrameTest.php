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
            $frame->addPinsToFrame(new Roll($item));
        }
        $this->assertEquals($output, $frame->getFrameScore());
    }

    public function framePinsProvider()
    {
        yield 'Frame #1' => ['input' => [10], 'output' => 10, 'expectException' => false];
        yield 'Frame #2' => ['input' => [10, 10], 'output' => null, 'expectException' => DomainException::class];
    }
}
