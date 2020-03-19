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

use App\NetworkHelper\AbstractNetworkHelper;

class RNGHelper extends AbstractNetworkHelper
{
    /**
     * RNGHelper constructor.
     */
    public function __construct()
    {
        parent::__construct(
            "loterioma_rng_helper",
            "http://loterioma_rng",
            80
        );
    }

    /**
     * Method returns
     * @param array $options
     * @return mixed
     */
    public function random(array $options)
    {
        return json_decode($this->makeRequest("GET", "/index.php/generate", [
            'seed' => $options['seed'] ?? 0,
            'range' => [
                'min' => 1,
                'max' => count($options['game']['symbols'])
            ],
            'matrix' => $options['play']['resultMatrix'] ?? $options['game']['matrix']
        ]));
    }
}