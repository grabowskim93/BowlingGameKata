<?php

namespace Test;

use App\Frame;
use PHPUnit\Framework\TestCase;

class FrameTest extends TestCase
{
    public function testFrameScore()
    {
        $frame = new Frame();

        $this->assertEquals(10, $frame->getFrameScore());
    }
}
