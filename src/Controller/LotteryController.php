<?php
//
//namespace App\Controller;
//
//use App\Engine\Lottery\LotteryEngine;
//use App\Model\Game\LotteryGame;
//use Symfony\Component\HttpFoundation\JsonResponse;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\Routing\Annotation\Route;
//
///**
// * @Route("/lottery")
// */
//class LotteryController extends GameController
//{
//    /**
//     * @Route("/play", name="lottery_play")
//     * @param Request $request
//     * @return JsonResponse
//     */
//    public function play(Request $request): JsonResponse
//    {
//        return $this->process(
//            $request->getContent(),
//            new LotteryEngine($this->mockGame()),
//            $this->getParams()
//        );
//    }
//
//    private function mockGame()
//    {
//        $game = [
//            'name' => 'Roulette',
//            'type' => 3,
//            'format' => [
//                [-1, -1, -1, -1, -1, -1],
//            ],
//            'rates' => [
//                1,
//                5,
//                10,
//                50,
//                100,
//            ],
//            'min' => 1,
//            'max' => 36,
//        ];
//
//        return new LotteryGame(
//            $game['name'],
//            $game['type'],
//            $game['min'],
//            $game['max'],
//            $game['format'],
//            $game['rates']
//        );
//    }
//
//    private function getParams()
//    {
//        return [
//            'bets' => [
//                [
//                    'rate' => 5,
//                    'numbers' => [1, 2, 3, 4, 5, 6]
//                ],
//                [
//                    'rate' => 5,
//                    'numbers' => [5, 6, 3, 6, 8, 4]
//                ],
//            ]
//        ];
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function createGameRequest()
//    {
//        // TODO: Implement createGameRequest() method.
//    }
//}
