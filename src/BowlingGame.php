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
     * @var int $currentFrameIndex Index of current frame.
     */
    private $currentFrameIndex;

    /**
     * @var int $rolls All game rolls.
     */
    private $rolls;

    /**
     * BowlingGame constructor.
     */
    public function __construct()
    {
        $this->score = 0;
        $this->pins = [];
        $this->rolls = [];
        $this->currentFrame = [];
        $this->frames = [];
        $this->currentFrameIndex = 0;
    }

    /**
     * Roll ball. Set pins.
     *
     * @param int $pins
     */
    public function roll(int $pins): void
    {
        $this->rolls[] = $pins;
    }

    /**
     * Get sum of pins after all rolls.
     *
     * @return int Total score.
     */
    public function score(): int
    {
        foreach ($this->rolls as $rollPins) {
            $this->scoreRoll($rollPins);
            $this->splitIntoFrames($rollPins);
            $this->scoreBonusPins();
            $this->currentFrameIndex = count($this->frames);
        }

        return $this->score;
    }

    /**
     * @param int $rollPins Pins in single roll.
     */
    private function splitIntoFrames(int $rollPins)
    {
        if (count($this->frames) >= self::FRAMES_AMOUNT) {
            $this->createFrame([$rollPins]);
        } elseif ($rollPins === self::STRIKE_SUM && count($this->pins) === 0) {
            $this->createFrame([$rollPins]);
        } elseif ((count($this->pins) === 1)) {
            $this->createFrame([$this->pins[0], $rollPins]);
        } else {
            $this->pins[] = $rollPins;
        }
    }

    /**
     * Add pins to overall score.
     *
     * @param int $pins Number of pins in roll.
     */
    private function scoreRoll(int $pins): void
    {
        if (count($this->frames) <= self::FRAMES_AMOUNT) {
            $this->score += $pins;
        }
    }

    /**
     * Score bouns pins from strike and spare.
     */
    private function scoreBonusPins()
    {
        $this->scoreSpare();
        $this->scoreStrike();
        if ($this->whetherExtraRoll()) {
            $this->scoreLastFrameStrike();
        }
    }

    /**
     * Create new frame, add to all frames array, score spare and strike.
     *
     * @param array $frame Frame containing rolls.
     */
    private function createFrame(array $frame): void
    {
        $this->currentFrame = $frame;
        $this->frames[] = $this->currentFrame;
        $this->pins = [];
    }

    /**
     * Add extra points if spare.
     */
    private function scoreSpare(): void
    {
        if ($this->whetherPreviousFrameByIndexExists(1)
            && $this->spareCondition()
        ) {
            $this->score += $this->currentFrame[0];
        }
    }

    /**
     * Check if spare in previous frame.
     *
     * @return bool True if spare in previous frame.
     */
    private function spareCondition()
    {
        return count($this->frames[$this->currentFrameIndex-1]) === self::FRAME_ROLLS
            && array_sum($this->frames[$this->currentFrameIndex-1]) === self::SPARE_SUM
            && count($this->pins) === 0;
    }

    /**
     * Add extra points if strike.
     */
    private function scoreStrike(): void
    {
        if ($this->whetherPreviousFrameByIndexExists(1)
            && count($this->frames) <= self::FRAMES_AMOUNT
            && $this->previousStrikeCondition(1)
        ) {
            $this->score += array_sum($this->currentFrame);

            if ($this->whetherPreviousFrameByIndexExists(2)
                && $this->previousStrikeCondition(2)) {
                $this->score += $this->currentFrame[0];
            }
        }
    }

    /**
     * @param int $frameIndex Check if previous frame by index exists.
     *
     * @return bool True if previous frame by index exists.
     */
    private function whetherPreviousFrameByIndexExists(int $frameIndex)
    {
        return isset($this->frames[$this->currentFrameIndex-$frameIndex]);
    }


    /**
     * Check if strike in x previous strike. Max x is 2.
     *
     * @param int $strikeIndex Previous strike index.
     *
     * @return bool True if strike occurs in previous frame by index.
     */
    private function previousStrikeCondition(int $strikeIndex)
    {
        return $this->frames[$this->currentFrameIndex-$strikeIndex][0] === self::STRIKE_SUM
            && count($this->pins) === 0;
    }

    /**
     * Score strike in last frame.
     */
    private function scoreLastFrameStrike(): void
    {
        $this->score += $this->currentFrame[0];
    }

    /**
     * @return bool True if it's 11 or 12 roll.
     */
    private function whetherExtraRoll()
    {
        return in_array(count($this->frames), [self::ONE_BEFORE_LAST_FRAME_STRIKE, self::LAST_FRAME_STRIKE]);
    }
}
