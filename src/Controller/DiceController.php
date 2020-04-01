<?php

namespace App\Controller;

use App\Engine\Dice\DiceEngine;
use App\Model\DTO\Game\DicePlayRequest;
use App\Model\Game\DiceGame;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dice")
 */
class DiceController extends GameController
{
    /**
     * @Route("/play", name="dice_play")
     * @param Request $request
     * @return JsonResponse
     */
    public function play(Request $request): JsonResponse
    {
        $requestContent = $request->getContent();

        return $this->process(
            $requestContent,
            new DiceEngine($this->mockGame()),
            $this->getParams()
        );
    }

    private function mockGame()
    {
        $game = [
            'name' => 'CrazyDice',
            'type' => 2,
            'format' => [
                [-1],
            ],
            'rates' => [
                1,
                5,
                10,
                50,
                100,
            ],
            'min' => 1,
            'max' => 6,
        ];

        return new DiceGame(
            $game['name'],
            $game['type'],
            $game['min'],
            $game['max'],
            $game['format'],
            $game['rates']
        );
    }

    private function getParams()
    {
        return [
            [
                'rate' => 5,
                'number' => 1,
            ],
            [
                'rate' => 5,
                'number' => 1,
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function createGameRequest()
    {
        return new DicePlayRequest();
    }
}
