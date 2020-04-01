<?php
/**
 * Container for the response object from network component.
 *
 * ~
 *
 * @category   DTO
 * @package    App\Model\DTO
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Model\DTO;

use PHPUnit\Exception;

class NetworkResponse
{
    const ERR_INVALID_JSON = [
        "message" => "Invalid body json.",
        "statusCode" => 500,
    ];

    /**
     * @var array|string
     */
    private $body;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $requestHash;

    /**
     * RNGResponse constructor.
     * @param array|string $body
     * @param int $statusCode
     * @param string $requestHash
     */
    public function __construct($body, int $statusCode, string $requestHash)
    {
        $this->body = json_decode($body, true);
        $this->statusCode = $statusCode;
        $this->requestHash = $requestHash;
    }

    /**
     * @return array|string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getRequestHash(): string
    {
        return $this->requestHash;
    }
}