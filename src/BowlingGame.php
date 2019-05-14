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

        $this->currentFrame->addRoleToFrame(new Roll($pins));

        $this->score += $pins;
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
}
