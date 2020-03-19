<?php
/**
 * An interface that provides the engine with basic game capabilities.
 *
 * ~
 *
 * @category   Interfaces
 * @package    App\Engine
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Engine;

use App\Model\GameRound;

interface GameEngineInterface
{
    /**
     * A method implementing the logic of a single round in the game.
     *
     * @param array $options
     * @return GameRound
     */
    public function play(array $options): GameRound;

    /**
     * @param GameRound $gameRound
     * @return mixed
     */
    public function sumUp(GameRound $gameRound);

    /**
     * @param GameRound $gameRound
     * @return mixed
     */
    public function flush(GameRound $gameRound);
}