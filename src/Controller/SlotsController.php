<?php
//
//namespace App\Controller;
//
//use App\Engine\Dice\DiceEngine;
//use App\Engine\Helpers\DiceWinningHelper;
//use App\Engine\Helpers\SlotsWinningHelper;
//use App\Engine\Slots\SlotsEngine;
//use App\Model\Game\SlotsGame;
//use App\Model\Round\AbstractRound;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Routing\Annotation\Route;
//
///**
// * @Route("/slots")
// */
//class SlotsController extends GameController
//{
//    /**
//     * @Route("/play", name="slots_play")
//     * @param Request $request
//     * @return JsonResponse
//     */
//    public function play(Request $request): JsonResponse
//    {
//        return $this->process(
//            $request->getContent(),
//            new SlotsEngine($this->mockGame())
//        );
//    }
//
//    private function mockGame()
//    {
//        $game = [
//            'name' => 'Game1',
//            'type' => 0,
//            'symbols' => [
//                [
//                    'id' => 1,
//                    'image' => 'pathtographic',
//                    'rate' => 3,
//                ],
//                [
//                    'id' => 2,
//                    'image' => 'pathtographic',
//                    'rate' => 3,
//                ],
//                [
//                    'id' => 3,
//                    'image' => 'pathtographic',
//                    'rate' => 3,
//                ],
//                [
//                    'id' => 4,
//                    'image' => 'pathtographic',
//                    'rate' => 4,
//                ],
//            ],
//            'format' => [
//                [-1, -1, -1],
//                [-1, -1, -1],
//                [-1, -1, -1],
//            ],
//            'rates' => [
//                1,
//                5,
//                10,
//                50,
//                100,
//            ],
//            'combinations' => [
//                [
//                    'name' => 'Line 3 up',
//                    'items' => [
//                        [0, 0],
//                        [0, 1],
//                        [0, 2],
//                    ],
//                    'order' => 0,
//                ],
//            ],
//            'min' => 1,
//            'max' => 4,
//        ];
//
//        return new SlotsGame(
//            $game['name'],
//            $game['type'],
//            $game['min'],
//            $game['max'],
//            $game['format'],
//            $game['rates'],
//            $game['symbols'],
//            $game['combinations']
//        );
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function createGameRequest()
//    {
//        return null;
//    }
//}
