<?php

namespace Test;

use App\Roll;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RollTest extends TestCase
{
    public function testRoll()
    {
        $this->expectException(InvalidArgumentException::class);
        new Roll(11);
        $this->expectException(InvalidArgumentException::class);
        new Roll(-1);
    }
}
