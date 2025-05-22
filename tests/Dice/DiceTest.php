<?php

namespace App\Test\Dice;

use App\Dice\Dice;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDice(): void
    {
        $die = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Construct stub object and controll roll and getValue methods is working.
     */
    public function testRoll(): void
    {
        $die = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $res = $die->roll();
        $this->assertNotEmpty($res);

        $res = $die->getValue();
        $this->assertNotEmpty($res);
    }
}
