<?php

/**
 * DiceEngine - @todo One sentence about that.
 *
 * @todo add file description
 *
 * See more: @todo add documentation link
 *
 * Engine - casino game server.
 * @see https://github.com/RaspberryVision/loterioma-engine
 *
 * This code is part of the LoterioMa casino system.
 * @see https://github.com/RaspberryVision/loterioma
 *
 * Created by Rafal Malik.
 * 19:47 21.03.2020, Warsaw/Zabki - DELL
 */

namespace App\Engine\Dice;

use App\Engine\GameEngine\AbstractGameEngine;
use App\Engine\Helpers\DiceWinningHelper;
use App\Engine\Helpers\WinningHelperInterface;
use App\Model\DTO\NetworkRequest;
use App\Model\Game\DiceGame;
use App\Model\ResultState\DiceResultState;
use App\Model\Round\AbstractRound;
use App\Model\Round\DiceRound;
use App\Model\Round\RoundInterface;
use App\Model\Round\SlotsRound;

/**
 * Implementation of the cube game engine using a random number generator.
 * @category   Engines
 * @package    App\Engine\PlayingDice
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class DiceEngine extends AbstractGameEngine
{
    /**
     * DiceEngine constructor.
     * @param DiceGame $game
     */
    public function __construct(DiceGame $game)
    {
        parent::__construct($game, new DiceWinningHelper());
    }

    /**
     * @param int $bet
     * @param array $params
     * @return DiceRound
     */
    public function play(int $bet, array $params = []): DiceRound
    {
        $gameRound = new DiceRound(
            $this->game,
            $bet,
            new DiceResultState($this->RNGHelper->random($this->requestOptions)),
            $params
        );

        $this->winning($gameRound);
        $this->flush($gameRound);

        return $gameRound;
    }

    /**
     * @param RoundInterface $gameRound
     * @return DiceRound
     */
    public function winning(RoundInterface $gameRound): AbstractRound
    {
        return $this->winningHelper->checkWinnings($gameRound);
    }

    /**
     * @param RoundInterface $gameRound
     * @return mixed
     */
    public function flush(RoundInterface $gameRound)
    {
        $this->coreHelper->processRound(new NetworkRequest(
            '/index.php/generate',
            $this->componentHash,
            $gameRound
        ));
    }

    /**
     * @param \App\Model\Round\RoundInterface $gameRound
     * @return bool
     * @todo Short description
     */
    public function simulate(RoundInterface $gameRound): bool
    {
        $gameRound2 = new DiceRound(
            $this->game,
            $bet,
            new DiceResultState($this->RNGHelper->random($this->requestOptions)),
            $params['bets']
        );

        $this->winning($gameRound);
        $this->flush($gameRound);

        return $gameRound;
    }

    public function random(): array
    {
        // TODO: Implement random() method.
    }
}