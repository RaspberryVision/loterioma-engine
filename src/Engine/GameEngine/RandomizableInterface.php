<?php
/**
 * Interface providing randomness.
 *
 * An interface offering a random method that provides access to random numbers
 * that will serve as the result of the game.
 *
 * @category   Interfaces
 * @package    App\Engine
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Engine\GameEngine;

use App\Model\DTO\GeneratorConfig;

interface RandomizableInterface
{
    function random(): array;

    function createGeneratorConfig(): GeneratorConfig;
}