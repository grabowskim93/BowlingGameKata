<?php

namespace App;

class Frame
{
    /**
     * @var int
     */
    private $pins;

    public function __construct()
    {
        $this->pins = 0;
    }

    public function getFrameScore()
    {
        return 10;
    }

}
