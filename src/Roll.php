<?php


namespace App;

class Roll
{
    /**
     * @var int
     */
    private $pins;

    /**
     * Roll constructor.
     *
     * @param int $pins
     */
    public function __construct(int $pins)
    {
        $this->pins = $pins;
    }

    public function getPins()
    {
        return $this->pins;
    }
}
