<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.03.20
 * Time: 19:07
 */

namespace App\Model\DTO;

interface NetworkRequestInterface
{
    function __construct(string $url, string $componentHash, $body);

    function getEndpoint(): string;

    function getComponentHash();

    public function getRequestParams();
}