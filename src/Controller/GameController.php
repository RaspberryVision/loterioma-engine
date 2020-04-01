<?php

namespace App\Controller;

use App\Engine\GameEngine\AbstractGameEngine;
use App\Model\DTO\Game\GameRequestInterface;
use App\Model\DTO\GamePlayRequest;
use App\Model\Game\GameMode;
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
     * @param array $gameParams
     * @return JsonResponse
     */
    protected function process(string $requestContent, AbstractGameEngine $engine, array $gameParams = []): JsonResponse
    {
        $requestParams = $this->handleRequest($this->createGameRequest(), $requestContent);

        if (!$requestParams) {
            return $this->json(
                [
                    'body' => 'Invalid request params.',
                    'debug' => [
                        'requestContent' => $requestContent
                    ]
                ]
            );
        }
        //$gameRound = $engine->play(5, $gameParams);
        switch ($requestParams->getMode()) {
            case 1:
            case 2:
                $gameRound = $engine->simulate(5, $gameParams);
                break;
            default:
                $gameRound = $engine->play(5, $gameParams);
        }

        if (!$gameRound instanceof RoundInterface) {
            throw new \LogicException('We got problem with determine game mode.');
        }

        return $this->json(
            [
                'body' => $gameRound->printInfo(),
            ]
        );
    }

    /**
     * Fetch request parameters, an incorrect format error is also handled.
     * @param GameRequestInterface $gameRequest
     * @param string $jsonRequest
     * @return GameRequestInterface|false
     */
    protected function handleRequest(GameRequestInterface $gameRequest, string $jsonRequest)
    {
        try {
            return $gameRequest->setFromJson($gameRequest, $jsonRequest);
        } catch (\Exception $exception) {
            var_dump($exception);
            return false;
        }
    }

    /**
     * @return mixed
     * @todo Short description
     */
    abstract public function createGameRequest();
}
