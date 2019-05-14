<?php

/**
 * Rolls and get score for game.
 */

namespace App;

/**
 * Class BowlingGame
 *
 * @package App
 */
class BowlingGame
{
    /**
     * @var int
     */
    private $score;

    /**
     * @var array
     */
    private $frames;

    /**
     * @var Frame
     */
    private $currentFrame;

    /**
     * BowlingGame constructor.
     */
    public function __construct()
    {
        $this->createFrame();
    }

    /**
     * Single bowling roll.

     * @param int $pins
     */
    public function roll(int $pins): void
    {
        if ($this->currentFrame->whetherCreateFrame() || $this->currentFrame->isStrike()) {
            $this->createFrame();
        }

        $this->currentFrame->addRollToFrame(new Roll($pins));

        $this->score += $pins;
        $strikeFrame = $this->getPreviousFrameByStep(1);
        if ($strikeFrame) {
            $strikeFrame->addPinsToFrame($pins);
            $this->score += $pins;
        }
    }

    /**
     * Get bowling game score.
     *
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Create new frame.
     */
    private function createFrame(): void
    {
        $this->currentFrame = new Frame();
        $this->frames[] = $this->currentFrame;
    }

    /**
     * Get frame for given step back
     *
     * @param $index
     *
     * @return Frame | bool
     */
    private function getPreviousFrameByStep(int $index)
    {
        if (count($this->frames) === 1) {
            return null;
        }

        $key = count($this->frames) - $index -1; //need -1 because array index start from 0.

        if (isset($this->frames[$key]) && $this->frames[$key]->isStrike()) {
            return $this->frames[$key];
        }

        return null;
    }
}
