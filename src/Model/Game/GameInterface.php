<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.03.20
 * Time: 20:18
 */

namespace App\Model\Game;

interface GameInterface
{
    public function getName(): string;

    public function getType(): int;

    public function getMin(): int;

    public function getMax(): int;

    public function getFormat(): array;
}