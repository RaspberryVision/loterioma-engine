<?php

/**
 * JsonInitializableInterface - @todo One sentence about that.
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
 * 21:08 22.03.2020, Warsaw/Zabki - DELL
 */

namespace App\Model\DTO;

use App\Model\DTO\Game\GameRequest;
use App\Model\DTO\Game\GameRequestInterface;

/**
 * @todo Short description
 */
interface JsonInitializableInterface
{
    public function setFromJson(GameRequestInterface $gameRequest, string $json);
}