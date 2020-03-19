<?php
/**
 * An abstract class representing an object of a specific Game.
 *
 * The game is called the engine configuration object, according to
 * which the game is played and the winnings are counted.
 *
 * @category   AbstractModels
 * @package    App\Model
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Model;

class AbstractGame
{
    protected const GAME_TYPE = -1;

    /** @var int $id */
    protected $id;

    /** @var string $name */
    protected $name;

    /** @var int $type */
    protected $type;

    /**
     * AbstractGame constructor.
     * @param string $name
     * @param int $type
     */
    public function __construct(string $name, int $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
}