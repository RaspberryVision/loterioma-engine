<?php

namespace App\Controller;

use App\Engine\GameEngine\AbstractGameEngine;
use App\Model\DTO\Game\GameRequestInterface;
use App\Model\DTO\GamePlayRequest;
use App\Model\Round\RoundInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @todo Short description
 * @category   @todo Add category
 * @package    App\Controller
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
abstract class GameController extends AbstractController
{
    /**
     * Process the flow of the delivered game.
     * @param string $requestContent
     * @param AbstractGameEngine $engine
     * @return JsonResponse
     */
    protected function process(string $requestContent, AbstractGameEngine $engine): JsonResponse
    {
        $requestParameters = $this->handleRequest($requestContent);

        if (!$requestParameters instanceof GameRequestInterface) {
            return $this->json(
                [
                    'body' => 'Invalid request params.',
                    'debug' => [
                        'requestContent' => $requestContent
                    ]
                ]
            );
        }

        switch ($requestParameters->getMode()) {
            case 1:
            case 2:
                $gameRound = $engine->simulate(5);
                break;
            default:
                $gameRound = $engine->play($requestParameters);
        }

        if (!$gameRound instanceof RoundInterface) {
            throw new \LogicException('We got problem with determine game mode.');
        }

        $engine->flush($gameRound);

        return $this->json(
            [
                'body' => $gameRound->printInfo(),
            ]
        );
    }

    /**
     * Fetch request parameters, an incorrect format error is also handled.
     * @param string $jsonData
     * @return GameRequestInterface|false
     */
    protected function handleRequest(string $jsonData)
    {
        try {
            return $this->createGameRequest($jsonData);
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param $jsonData
     * @return mixed
     * @todo Short description
     */
    abstract public function createGameRequest($jsonData);
}
