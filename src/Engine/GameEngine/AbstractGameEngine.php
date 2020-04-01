<?php
/**
 * Implementation of GameEngine.
 *
 * Currently, it is a game engine that will eventually become an abstract engine and separate:
 * - SlotsGameEngine
 * - CardGameEngine
 * - LotteryGameEngine
 *
 * @category   Engines
 * @package    App\Engine
 * @author     Rafal Malik <kontakt@raspberryvision.pl>
 * @copyright  03.2020 Raspberry Vision
 */

namespace App\Engine\GameEngine;

use App\Engine\Helpers\SlotsWinningHelper;
use App\Engine\Helpers\WinningHelperInterface;
use App\Engine\SlotsEngine\SlotsEngine;
use App\Model\DTO\GeneratorConfig;
use App\Model\DTO\NetworkRequest;
use App\Model\DTO\NetworkRequestInterface;
use App\Model\Game\GameInterface;
use App\Model\Round\AbstractRound;
use App\Model\Round\RoundInterface;
use App\NetworkHelper\RNG\RNGHelper;

/**
 * The abstract game engine is the basis for games based on the pseudo-random mechanism.
 * @category   Engines
 * @package    App\Engine\GameEngine
 * @author     Rafal Malik <rafalmalik.info@gmail.com>
 * @copyright  03.2020 Raspberry Vision
 */
abstract class AbstractGameEngine implements
    PlayableInterface,
    FlushableInterface,
    WinnableInterface,
    SimulableInterface,
    RandomizableInterface
{
    /**
     * @var string $componentHash
     */
    protected $componentHash;

    /**
     * @var GameInterface $game
     */
    protected GameInterface $game;

    /**
     * @var RNGHelper $RNGHelper
     */
    protected RNGHelper $RNGHelper;

    /**
     * @var NetworkRequestInterface $requestOptions
     */
    protected $requestOptions;

    /**
     * @var WinningHelperInterface $winningHelper
     */
    protected WinningHelperInterface $winningHelper;

    /**
     * GameEngine constructor.
     * @param GameInterface $game
     * @param WinningHelperInterface $winningHelper
     */
    public function __construct(GameInterface $game, WinningHelperInterface $winningHelper)
    {
        $this->RNGHelper = new RNGHelper();
        $this->winningHelper = $winningHelper;
        $this->game = $game;
        $this->componentHash = uniqid('', true);
        $this->requestOptions = new NetworkRequest(
            '/index.php/generate',
            $this->componentHash,
            $this->createGeneratorConfig()
        );
    }

    /**
     * @param int $bet
     * @param array $params
     * @return AbstractRound
     */
    abstract public function play(int $bet, array $params = []): AbstractRound;

    /**
     * @param RoundInterface $gameRound
     * @return mixed
     */
    abstract public function flush(RoundInterface $gameRound);

    /**
     * A method that allows simulation of the game based on the round provided
     * @param RoundInterface $gameRound
     * @return bool
     */
    abstract public function simulate(RoundInterface $gameRound): bool;

    /**
     * @param RoundInterface $round
     * @return AbstractRound
     */
    abstract public function winning(AbstractRound $round): AbstractRound;

    /**
     * Create GeneratorConfig object based on loaded $game.
     * @return GeneratorConfig
     */
    public function createGeneratorConfig(): GeneratorConfig
    {
        return new GeneratorConfig(
            $this->game->getMin(),
            $this->game->getMax(),
            $this->game->getFormat()
        );
    }
}