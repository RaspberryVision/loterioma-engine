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

class NetworkRequest implements NetworkRequestInterface
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var array|string
     */
    private $body;

    /**
     * @var string
     */
    private $componentHash;

    /**
     * NetworkRequest constructor.
     * @param string $endpoint
     * @param string $componentHash
     * @param array|string $body
     */
    public function __construct(string $endpoint, string $componentHash, $body)
    {
        $this->endpoint = $endpoint;
        $this->componentHash = $componentHash;
        $this->body = $body;
    }

    /**
     * Prepare request params to send.
     *
     * @return array
     */
    public function getRequestParams()
    {
        return [
            'hash' => $this->componentHash,
            'time' => date('Y-m-d H:i:s'),
            'requestHash' => uniqid('eng_rng_', true),
            'body' => $this->normalizeBody($this->body)
        ];
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getComponentHash(): string
    {
        return $this->componentHash();
    }

    public function normalizeBody(NormalizableBodyInterface $body)
    {
        return $body->normalizeBody();
    }
}