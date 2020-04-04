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
     * @Route("/play/{id}", name="dice_play")
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function play(Request $request, int $id): JsonResponse
    {
        return $this->process(
            $request->getContent(),
            new DiceEngine($this->mockGame())
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
    public function createGameRequest($jsonData): DicePlayRequest
    {
        return new DicePlayRequest($jsonData);
    }
}
