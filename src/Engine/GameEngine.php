<?php
/**
 * Implementation of GameEngine.
 *
 * Currently, it is a game engine that will eventually become an abstract engine and separate:
 * - SlotsGameEngine
 * - CardGameEngine
 * - LotteryGameEngine
 *
 * @category   Engines
 * @package    App\Engine
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Engine;

use App\Model\AbstractGame;
use App\Model\GameRound;
use App\Model\SlotsGame;
use App\NetworkHelper\RNG\RNGHelper;

class GameEngine implements GameEngineInterface
{
    /** @var SlotsGame $game */
    private $game;

    /** @var RNGHelper $RNGHelper */
    private $RNGHelper;

    /**
     * GameEngine constructor.
     * @param AbstractGame $game
     */
    public function __construct(AbstractGame $game)
    {
        $this->RNGHelper = new RNGHelper();
        $this->game = $game;
    }

    /**
     * @return AbstractGame
     */
    public function getGame(): AbstractGame
    {
        return $this->game;
    }

    /**
     * @param array $options
     * @return GameRound
     */
    public function play(array $options): GameRound
    {
        $gameRound = new GameRound(
            $this->game,
            $options['play']['bet'],
            $this->RNGHelper->random($options)
        );

        $this->sumUp($gameRound);

        $this->flush($gameRound);

        return $gameRound;
    }

    /**
     * @param GameRound $gameRound
     */
    public function sumUp(GameRound $gameRound)
    {
        $this->checkWins($gameRound);

        if ($gameRound->isWin()) {
        }
    }

    /**
     * @param GameRound $gameRound
     */
    private function checkWins(GameRound $gameRound)
    {
        foreach ($this->game->getCombinations() as $combination) {

            if ($this->checkCombination($gameRound->getMatrix(), $combination)) {
                $gameRound->addCombination($combination);
            }
        }
    }

    /**
     * @param array $matrix
     * @param array $combination
     * @return bool
     */
    private function checkCombination(array $matrix, array $combination)
    {
        $seriesId = null;

        foreach ($combination as $field) {

            if (!$seriesId) {
                $seriesId = $matrix[$field[0]][$field[1]];
            } elseif ($seriesId != $matrix[$field[0]][$field[1]]) {
                continue;
            }
        }

        return $seriesId ? true : false;
    }

    /**
     * @param GameRound $gameRound
     * @return mixed
     */
    public function flush(GameRound $gameRound)
    {
        // TODO: Implement flush() method.
    }
}