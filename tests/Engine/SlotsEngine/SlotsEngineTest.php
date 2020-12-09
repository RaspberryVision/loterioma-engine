<?php

/**
 * Unit testing for GameEngine class.
 *
 * ~
 *
 * @category   UnitTests
 * @package    App\Tests\Engine
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Tests\Engine\SlotsEngine;

use App\Engine\GameEngine\FlushableInterface;
use App\Engine\GameEngine\WinnableInterface;
use App\Engine\GameEngine\PlayableInterface;
use App\Engine\SlotsEngine\SlotsEngine;
use App\Model\Game\GameInterface;
use App\Model\Game\SlotsGame;
use App\Model\Round\AbstractRound;
use App\Model\Round\RoundInterface;
use PHPUnit\Framework\TestCase;

class GameEngineTest extends TestCase
{
    /**
     * Check that GameEngine class implement PlayableInterface.
     *
     * @dataProvider dataProviderCreate
     * @param array $testCase
     */
    public function testDoesImplementInterfaces(array $testCase)
    {
        $gameEngine = $this->createGameEngine($testCase);

        $this->assertInstanceOf(PlayableInterface::class, $gameEngine);
        $this->assertInstanceOf(FlushableInterface::class, $gameEngine);
        $this->assertInstanceOf(WinnableInterface::class, $gameEngine);
    }

    /**
     * Test that create new instance by constructor correctly sets field values.
     *
     * @dataProvider dataProviderCreate
     * @param array $testCase
     */
    public function testCreate(array $testCase)
    {
        $gameEngine = $this->createGameEngine($testCase);

        $game = $gameEngine->getGame();

        $this->assertInstanceOf(GameInterface::class, $game);
        $this->assertEquals($testCase['game']['name'], $game->getName());
        $this->assertEquals($testCase['game']['symbols'], $game->getSymbols());
        $this->assertEquals($testCase['game']['matrix'], $game->getMatrix());
        $this->assertEquals($testCase['game']['bets'], $game->getBets());
    }

    /**
     * Data provider for testCreateInstance.
     *
     * @return \Generator
     */
    public function dataProviderCreate()
    {
        yield [
            [
               'game' => [
                   'name' => 'Game1',
                   'type' => 0,
                   'symbols' => [
                       [
                           'id' => 1,
                           'image' => 'pathtographic',
                           'rate' => 3
                       ],
                       [
                           'id' => 2,
                           'image' => 'pathtographic',
                           'rate' => 3
                       ],
                       [
                           'id' => 3,
                           'image' => 'pathtographic',
                           'rate' => 3
                       ]
                   ],
                   'combinations' => [
                       [
                           [0, 0],
                           [0, 1],
                           [0, 2]
                       ]
                   ],
                   'matrix' => [
                       [-1, -1, -1],
                       [-1, -1, -1],
                       [-1, -1, -1],
                   ],
                   'bets' => [
                       1, 5, 10, 50, 100
                   ]
               ]
            ]
        ];
    }

    /**
     * Test simulating play action on the GameEngine.
     *
     * @dataProvider dataProviderPlay
     * @param array $testCase
     */
    public function testPlay(array $testCase)
    {
        $gameEngine = $this->createGameEngine(
            $testCase
        );

        $gameRound = $gameEngine->play($testCase);

        $this->assertInstanceOf(RoundInterface::class, $gameRound);
        $this->assertContains($gameRound->getBet(), $gameEngine->getGame()->getBets());
        $this->assertEquals(false, $gameRound->isEnded());
        $this->assertEquals(
            AbstractRound::STATUS_DRAWN,
            $gameRound->getStatus()
        );

        $gameEngine->sumUp($gameRound);
    }

    /**
     * Data provider for testPlay.
     *
     * @return \Generator
     */
    public function dataProviderPlay()
    {
        yield [
            [
                'game' => [
                    'name' => 'Game1',
                    'type' => 0,
                    'symbols' => [
                        [
                            'id' => 1,
                            'image' => 'pathtographic',
                            'rate' => 3
                        ],
                        [
                            'id' => 2,
                            'image' => 'pathtographic',
                            'rate' => 3
                        ],
                        [
                            'id' => 3,
                            'image' => 'pathtographic',
                            'rate' => 3
                        ],
                        [
                            'id' => 4,
                            'image' => 'pathtographic',
                            'rate' => 4
                        ]
                    ],
                    'isInit' => true,
                    'matrix' => [
                        [-1, -1, -1],
                        [-1, -1, -1],
                        [-1, -1, -1],
                    ],
                    'bets' => [
                        1, 5, 10, 50, 100
                    ],
                    'combinations' => [
                        [
                            [0, 0],
                            [0, 1],
                            [0, 2]
                        ]
                    ]
                ],
                'play' => [
                    'bet' => 5,
                    'resultMatrix' => [
                        [2, 2, 2],
                        [1, 3, 2],
                        [3, 1, 4],
                    ],
                    'status' => AbstractRound::STATUS_WON,
                    'amount' => 45
                ]
            ]
        ];
    }

    /**
     * Helper method to create GameEngine object based on constructor
     * params and return it to test.
     *
     * @param array $testCase
     * @return SlotsEngine
     */
    private function createGameEngine(array $testCase)
    {
        return new SlotsEngine(
            $this->createGame($testCase['game'])
        );
    }

    /**
     * @param array $testCase
     * @return SlotsGame
     */
    private function createGame(array $testCase)
    {
        return new SlotsGame(
            $testCase['name'],
            $testCase['type'],
            $testCase['matrix'],
            $testCase['symbols'],
            $testCase['payouts'],
            $testCase['bets']
        );
    }
}