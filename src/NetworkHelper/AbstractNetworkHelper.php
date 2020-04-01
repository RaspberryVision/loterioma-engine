<?php
/**
 * Abstract network helper.
 *
 * An abstract helper class that provides basic methods
 * for communicating with other components using an API.
 *
 * @category   AbstractHelpers
 * @package    App\NetworkHelper
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\NetworkHelper;

use App\Model\DTO\NetworkRequestInterface;
use App\Model\DTO\NetworkResponse;
use PHPUnit\Exception;

abstract class AbstractNetworkHelper
{
    /** @var string $name */
    protected $name;

    /** @var string $url */
    protected $url;

    /** @var int $port */
    protected $port;

    /**
     * AbstractNetworkHelper constructor.
     * @param string $name
     * @param string $url
     * @param int $port
     */
    public function __construct(string $name, string $url, int $port)
    {
        $this->name = $name;
        $this->url = $url;
        $this->port = $port;
    }

    /**
     * @return string
     */
    protected function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return int
     */
    protected function getPort(): int
    {
        return $this->port;
    }

    /**
     * Method call API request to NetworkComponent.
     *
     * @param string $endpoint
     * @param array $requestParams
     * @return NetworkResponse
     */
    protected function makeGetRequest(string $endpoint, array $requestParams)
    {
        $curlResponse = $this->makeCurl(
            $endpoint,
            json_encode($requestParams)
        );

        return $this->createResponse($curlResponse);
    }

    /**
     * @param string $endpoint
     * @param string $parameters
     * @return mixed
     */
    private function makeCurl(string $endpoint, string $parameters)
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $this->getRequestUrl($endpoint),
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $parameters,
            ]
        );

        $jsonResponse = curl_exec($curl);
        curl_close($curl);

        return $jsonResponse;
    }

    /**
     * @param string $json
     * @return NetworkResponse
     */
    protected function createResponse(string $json)
    {
        return new NetworkResponse($json, 200, 'sadsad');
    }

    /**
     * Prepare full url to component.
     *
     * @param string $endpoint
     * @return string
     */
    private function getRequestUrl(string $endpoint)
    {
        return sprintf(
            "%s:%d%s",
            $this->url,
            $this->port,
            $endpoint
        );
    }
}