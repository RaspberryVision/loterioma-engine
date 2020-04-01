<?php

/**
 * DicePlayRequest - @todo One sentence about that.
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
 * 21:50 22.03.2020, Warsaw/Zabki - DELL
 */

namespace App\Model\DTO\Game;

use App\Model\DTO\JsonInitializableInterface;

/**
 * O
 * @category   @todo Add category
 * @package    App\Model\DTO\Game
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class DicePlayRequest extends GameRequest
{
    /**
     * @var array $intentions Options added to game, for example bets.
     */
    private array $bets;

    /**
     * Transform object to parameters used as HTTP request params.
     * @param GameRequestInterface $gameRequest
     * @param string $json
     * @return DicePlayRequest
     */
    public function setFromJson(GameRequestInterface $gameRequest, string $json) {
        return parent::setFromJson($gameRequest, $json);
    }
}