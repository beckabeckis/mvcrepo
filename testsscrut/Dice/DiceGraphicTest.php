<?php

namespace App\Test\Dice;

use App\Dice\DiceGraphic;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceGraphic.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDice(): void
    {
        $die = new DiceGraphic();
        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $die->roll();
        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }
}
