<?php

namespace App\Controller;

use App\Engine\Dice\DiceEngine;
use App\Engine\Roulette\RouletteEngine;
use App\Model\Game\DiceGame;
use App\Model\Game\RouletteGame;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/roulette")
 */
class RouletteController extends GameController
{
    /**
     * @Route("/play", name="roulette_play")
     * @param Request $request
     * @return JsonResponse
     */
    public function play(Request $request): JsonResponse
    {
        return $this->process(
            $request->getContent(),
            new RouletteEngine($this->mockGame()),
            $this->getParams()
        );
    }

    private function mockGame()
    {
        $game = [
            'name' => 'Roulette',
            'type' => 3,
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
            'max' => 36,
        ];

        return new RouletteGame(
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
            'bets' => [
                [
                    'rate' => 5,
                    'number' => 21
                ],
                [
                    'rate' => 5,
                    'number' => 1
                ],
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public function createGameRequest()
    {
        // TODO: Implement createGameRequest() method.
    }
}
