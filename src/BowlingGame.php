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
     * @var int SPARE_SUM Amount of pins required for spare.
     */
    const SPARE_SUM = 10;

    /**
     * @var int STRIKE_SUM Amount of pins required for strike.
     */
    const STRIKE_SUM = 10;

    /**
     * @vat int ONE_BEFORE_LAST_FRAME_STRIKE One before last frame - strike case.
     */
    const ONE_BEFORE_LAST_FRAME_STRIKE = 11;

    /**
     * @var int LAST_FRAME_STRIKE Last frame - strike case.
     */
    const LAST_FRAME_STRIKE = 12;

    /**
     * @var  int FRAMES_AMOUNT Amount of allowed frames.
     */
    const FRAMES_AMOUNT = 10;


    /**
     * @var int FRAME_ROLLS Amount of rolls in spare or normal frame.
     */
    const FRAME_ROLLS = 2;

    /**
     * @var array $pins Array with all rolls pins.
     */
    private $pins;

    /**
     * @var int $score Total score of game.
     */
    private $score;

    /**
     * @var array $currentFrame Current frame with rolls.
     */
    private $currentFrame;

    /**
     * @var array $frames Array of all game frames.
     */
    private $frames;

    /**
     * BowlingGame constructor.
     */
    public function __construct()
    {
        $this->score = 0;
        $this->pins = [];
        $this->currentFrame = [];
        $this->frames = [];
    }

    /**
     * Roll ball.
     *
     * @param int $pins
     */
    public function roll(int $pins): void
    {
        if (count($this->frames) <= self::FRAMES_AMOUNT) {
            $this->score += $pins;
        }

        if (count($this->frames) >= self::FRAMES_AMOUNT) {
            $this->createFrameAndScoreExtraPins([$pins]);
        } elseif ($pins === self::STRIKE_SUM && count($this->pins) === 0) {
            $this->createFrameAndScoreExtraPins([$pins]);
        } elseif ((count($this->pins) === 1)) {
            $this->createFrameAndScoreExtraPins([$this->pins[0], $pins]);
        } else {
            $this->pins[] = $pins;
        }
    }

    /**
     * Get sum of pins after rolls.
     *
     * @return int
     */
    public function score(): int
    {
        return $this->score;
    }

    /**
     * Create new frame, add to all frames array, score spare and strike.
     *
     * @param array $frame
     */
    private function createFrameAndScoreExtraPins(array $frame): void
    {
        $this->currentFrame = $frame;
        $this->frames[] = $this->currentFrame;
        $this->pins = [];
        $this->scoreSpare();
        $this->scoreStrike();
    }

    /**
     * Add extra points if spare.
     */
    private function scoreSpare(): void
    {
        $currentFrame = count($this->frames) - 1; //because increments from 0.
        if (isset($this->frames[$currentFrame-1])
            && count($this->frames[$currentFrame-1]) === self::FRAME_ROLLS
            && array_sum($this->frames[$currentFrame-1]) === self::SPARE_SUM
        ) {
            $this->score += $this->currentFrame[0];
        }
    }

    /**
     * Add extra points if strike.
     */
    private function scoreStrike(): void
    {
        $currentFrame = count($this->frames) - 1; //because increments from 0.
        if (isset($this->frames[$currentFrame-1])
            && count($this->frames) <= self::FRAMES_AMOUNT
            && $this->frames[$currentFrame-1][0] === self::STRIKE_SUM
        ) {
            $this->score += array_sum($this->currentFrame);

            if (isset($this->frames[$currentFrame-2]) && $this->frames[$currentFrame-2][0] === self::STRIKE_SUM) {
                $this->score += $this->currentFrame[0];
            }
        }

        $this->scoreLastFrameStrike();
    }

    /**
     * Score strike in last frame.
     */
    private function scoreLastFrameStrike(): void
    {
        if (in_array(count($this->frames), [self::ONE_BEFORE_LAST_FRAME_STRIKE, self::LAST_FRAME_STRIKE])) {
            $this->score += $this->currentFrame[0];
        }
    }
}
