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
     * @param string $method
     * @param string $url
     * @param array $data
     * @return mixed
     */
    protected function makeRequest(string $method, string $url, array $data = [])
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->getRequestUrl($url),
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => json_encode($data)
        ]);

        $output = curl_exec($curl);
        curl_close($curl);

        return $output;
    }

    /**
     * Prepare full url to component.
     *
     * @param string $endpoint
     * @return string
     */
    private function getRequestUrl(string $endpoint)
    {
        return sprintf("%s:%d%s",
            $this->url,
            $this->port,
            $endpoint
        );
    }
}