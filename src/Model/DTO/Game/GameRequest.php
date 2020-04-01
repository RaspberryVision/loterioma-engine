<?php
/**
 * A container for the Random Number Generator configuration.
 *
 * ~
 *
 * @category   DTO
 * @package    App\Model\DTO
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Model\DTO\Game;

use App\Model\DTO\JsonInitializableInterface;

/**
 * Object for game play action params.
 * @category   Models
 * @package    App\Model\DTO
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class GameRequest implements JsonInitializableInterface, GameRequestInterface
{
    /**
     * @var string $gameHash Unique game hash.
     */
    private string $gameHash;

    /**
     * @var string $client Client app hash.
     */
    private string $client;

    /**
     * @var string $userHash
     */
    private string $userHash;

    /**
     * @var int $mode Specific game mode.
     */
    private int $mode;

    /**
     * @return string
     */
    public function getGameHash(): string
    {
        return $this->gameHash;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getUserHash(): string
    {
        return $this->userHash;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->mode;
    }

    /**
     * Transform object to parameters used as HTTP request params.
     * @param GameRequestInterface $request
     * @param string $json
     * @return GameRequest|false
     */
    public function setFromJson(GameRequestInterface $request, string $json)
    {
        $data = json_decode($json);

        if (!$data) {
            return false;
        }

        foreach ($data as $key => $value) {
            $request->{$key} = $value;
        }

        return $request;
    }
}