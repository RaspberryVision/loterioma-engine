<?php
/**
 * An class representing an object of a specific Slots Game.
 *
 * The object describing the configuration of the gaming machine denotes symbols,
 * available rates, paid lines as well as the size of the game matrix itself,
 *
 * @category   AbstractModels
 * @package    App\Model
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Model;

class SlotsGame extends AbstractGame
{
    const GAME_TYPE = 1;

    /** @var array $matrix */
    private $matrix;

    /** @var array $symbols */
    private $symbols;

    /** @var array $combinations */
    private $combinations;

    /** @var array $bets */
    private $bets;

    /**
     * SlotsGame constructor.
     * @param string $name
     * @param int $type
     * @param array $matrix
     * @param array $symbols
     * @param array $combinations
     * @param array $bets
     */
    public function __construct(
        string $name,
        int $type,
        array $matrix,
        array $symbols,
        array $combinations,
        array $bets)
    {
        parent::__construct($name, $type);
        $this->matrix = $matrix;
        $this->symbols = $symbols;
        $this->combinations = $combinations;
        $this->bets = $bets;
    }

    /**
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->matrix;
    }

    /**
     * @return array
     */
    public function getSymbols(): array
    {
        return $this->symbols;
    }

    /**
     * @return array
     */
    public function getCombinations(): array
    {
        return $this->combinations;
    }

    /**
     * @return array
     */
    public function getBets(): array
    {
        return $this->bets;
    }
}