<?php

namespace App\Controller;

use App\Engine\Dice\DiceEngine;
use App\Model\DTO\Game\DicePlayRequest;
use App\Model\Game\DiceGame;
use App\NetworkHelper\DataStore\DataStoreHelper;
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
     * @param int $id
     * @param Request $request
     * @param DataStoreHelper $dataStoreHelper
     * @return JsonResponse
     */
    public function play(int $id, Request $request, DataStoreHelper $dataStoreHelper): JsonResponse
    {
        $gameObject = $dataStoreHelper->fetchGame($id);

        return $this->process(
            $request->getContent(),
            new DiceEngine($gameObject)
        );
    }

    /**
     * @inheritDoc
     */
    public function createGameRequest($jsonData): DicePlayRequest
    {
        return new DicePlayRequest($jsonData);
    }
}
