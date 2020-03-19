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

namespace App\Tests\Generator;

use PHPUnit\Framework\TestCase;

class GameEngineTest extends TestCase
{
    /**
     * Check that GameEngine class implement GameableInterface.
     *
     * @dataProvider dataProviderCreate
     * @param array $testCase
     */
    public function testDoesImplementGameableInterface(array $testCase)
    {
        $gameEngine = $this->createGameEngine($testCase);

        $this->assertInstanceOf(GameableInterface::class, $gameEngine);
    }

    /**
     * Test that create new instance by constructor correctly sets field values.
     *
     * @dataProvider dataProviderCreate
     * @param array $testCase
     */
    public function testCreate(array $testCase)
    {
        $gameEngine = $this->createGameEngine(
            $testCase
        );

        $game = $gameEngine->getGame();

        $this->assertInstanceOf(AbstractGame::class, $game);

        $this->assertInstanceOf(PlayableInterface::class, $gameEngine);

        $this->assertEquals($testCase['name'], $game->getName());
        $this->assertEquals($testCase['symbols'], $game->getSymbols());
        $this->assertEquals($testCase['matrix'], $game->getMatrix());
        $this->assertEquals($testCase['bets'], $game->getBets());
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
                'name' => 'Game1',
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
                'matrix' => [
                    [-1, -1, -1],
                    [-1, -1, -1],
                    [-1, -1, -1],
                ],
                'bets' => [
                    1, 5, 10, 50, 100
                ]
            ]
        ];
    }

    /**
     * Test simulating play action on the GameEngine.
     *
     * @param array $testCase
     */
    public function testPlay(array $testCase)
    {
        $gameEngine = $this->createGameEngine(
            $testCase['config']
        );

        $gameRound = $gameEngine->play($testCase['play']);

        $this->assertInstanceOf(AbstractGameRound::class, $gameRound);

        $this->assertContains($gameRound->getBet(), $gameEngine->getGame()->getBets());

        $this->assertEquals(true, $gameRound->isEnded());

        $this->assertEquals(
            true,
            $this->logicalOr(
                $this->assertEquals(GameRound::STATUS_WON, $gameRound->getStatus()),
                $this->assertEquals(GameRound::STATUS_LOST, $gameRound->getStatus())
            )
        );

        $this->assertEquals(
            false,
            $gameRound->isSaved()
        );
    }

    /**
     * The method checks if the game is successful and if the GameRound status is correct.
     * @dataProvider dataProviderCreate
     * @param array $testCase
     */
    public function testCheckWins(array $testCase)
    {
        $gameEngine = $this->createGameEngine(
            $testCase['game']
        );

        $gameRound = $gameEngine->play($testCase['play']);

        $this->assertEquals($testCase['play']['status'], $gameRound->getStatus());

        if ($testCase['play']['status']) {
            $this->assertEquals($testCase['play']['amount'], $gameRound()->getWinAmount());
        }
    }

    /**
     * Data provider for testCheckWins.
     *
     * @return \Generator
     */
    public function dataProviderCheckWins()
    {
        yield [
            [
                'game' => [
                    'name' => 'Game1',
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
                    'payouts' => [
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
                    'status' => GameRound::STATUS_WON,
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
     * @return GameEngine
     */
    private function createGameEngine(array $testCase)
    {
        return new GameEngine(
            $testCase
        );
    }
}