<?php
/**
 * An class representing an object of a specific GameRound in the Game.
 *
 * ~
 *
 * @category   AbstractModels
 * @package    App\Model
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Model;

class GameRound
{
    const STATUS_DRAWN = 0;
    const STATUS_LOST = 1;
    const STATUS_WON = 2;

    /**
     * @var int $id
     */
    private $id;

    /**
     * @var int $bet
     */
    private $bet;

    /**
     * @var AbstractGame $game The game the round is for.
     */
    private $game;

    /**
     * @var int $status Represents the status of the game in terms of win.
     */
    private $status;

    /**
     * @var int $amount The amount won in a round.
     */
    private $amount;

    /**
     * @var array $matrix Represents the state of round.
     */
    private $matrix;

    /** @var array $wonCombinations Collection of winning combination. */
    private $wonCombinations;

    /**
     * AbstractGameRound constructor.
     * @param AbstractGame $game
     * @param int $bet
     * @param array $matrix
     */
    public function __construct(AbstractGame $game, int $bet, array $matrix)
    {
        $this->status = self::STATUS_DRAWN;
        $this->game = $game;
        $this->bet = $bet;
        $this->matrix = $matrix;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getBet(): int
    {
        return $this->bet;
    }

    /**
     * @return AbstractGame
     */
    public function getGame(): AbstractGame
    {
        return $this->game;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->matrix;
    }

    /**
     * If $status != STATUS_INIT return true - gameRound is ended,
     * otherwise return false.
     *
     * @return bool
     */
    public function isEnded(): bool
    {
        if (self::STATUS_DRAWN === $this->getStatus()) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function isWin(): bool
    {
        return count($this->wonCombinations) > 0;
    }

    /**
     * @param array $combination
     */
    public function addCombination(array $combination)
    {
        $this->wonCombinations [] = $combination;
        $this->amount += 5;
    }
}