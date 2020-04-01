<?php

/**
 * GameRequestInterface - @todo One sentence about that.
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
 * 21:13 22.03.2020, Warsaw/Zabki - DELL
 */

namespace App\Model\DTO\Game;

/**
 * @todo Short description
 */
interface GameRequestInterface
{
    public function getGameHash(): string;

    public function getClient(): string;

    public function getUserHash(): string;

    public function getMode(): int;
}