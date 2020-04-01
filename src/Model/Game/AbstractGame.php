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

namespace App\Model\Game;

/**
 * Abstract game model, provide basic properties and methods.
 * @category   Models
 * @package    App\Model\Game
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
abstract class AbstractGame implements GameInterface
{
    protected const GAME_TYPE = -1;

    /**
     * @var int $id
     */
    protected int $id;

    /**
     * @var string $name
     */
    protected string $name;

    /**
     * @var int $type
     */
    protected int $type;

    /**
     * @var int $min
     */
    protected int $min;

    /**
     * @var int $max
     */
    protected int $max;

    /**
     * @var array $format
     */
    protected array $format;

    /** @var array $rates */
    private array $rates;

    /**
     * AbstractGame constructor.
     * @param string $name
     * @param int $type
     * @param int $min
     * @param int $max
     * @param array $format
     * @param array $rates
     */
    public function __construct(string $name, int $type, int $min, int $max, array $format, array $rates)
    {
        $this->name = $name;
        $this->type = $type;
        $this->min = $min;
        $this->max = $max;
        $this->format = $format;
        $this->rates = $rates;
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

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @return array
     */
    public function getFormat(): array
    {
        return $this->format;
    }

    /**
     * @return array
     */
    public function getRates(): array
    {
        return $this->rates;
    }
}