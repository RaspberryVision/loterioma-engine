<?php
/**
 * Curl helper to RandomNumberGenerator.
 *
 * An auxiliary class providing methods for performing API queries to the loterioma-rng component.
 *
 * @category   Helpers
 * @package    App\NetworkHelper\RNG
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\NetworkHelper\RNG;

use App\Model\DTO\NetworkRequestInterface;
use App\Model\DTO\NetworkResponse;
use App\NetworkHelper\AbstractNetworkHelper;

/**
 * Helper providing communication with a random number generator.
 * @category   NetworkHelper
 * @package    App\NetworkHelper\RNG
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
class RNGHelper extends AbstractNetworkHelper
{
    /**
     * RNGHelper constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'loterioma_rng_helper',
            'http://loterioma_rng',
            80
        );
    }

    /**
     * Method returns
     * @param NetworkRequestInterface $networkRequest
     * @return NetworkResponse
     */
    public function random(NetworkRequestInterface $networkRequest): NetworkResponse
    {
        return $this->makeGetRequest($networkRequest->getEndpoint(), $networkRequest->getRequestParams());
    }
}