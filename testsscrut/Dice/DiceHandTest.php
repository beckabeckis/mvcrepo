<?php

namespace App\Test\Dice;

use App\Dice\DiceHand;
use App\Dice\Dice;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Stub the dices to assure the value can be asserted and test add and roll methods working.
     */
    public function testAddStubbedDices(): void
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);
        $stub->method('getValue')
            ->willReturn(6);

        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->roll();
        $res = $dicehand->sum();
        $this->assertEquals(12, $res);
    }

    /**
     * Stub the dices to assure the value can be asserted and test getNumberDices method working.
     */
    public function testGetNumberDices(): void
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $res = $dicehand->getNumberDices();
        $this->assertEquals(4, $res);
    }

    /**
     * Test addDicesMixed method working.
     */
    public function testAddDicesMixed(): void
    {
        $dicehand = new DiceHand();
        $dicehand->addDicesMixed(5);
        $res = $dicehand->getNumberDices();
        $this->assertEquals(5, $res);
    }

    /**
     * Stub the dices to assure the value can be asserted and test getNumberDices method working.
     */
    public function testGetValues(): void
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
            ->willReturn(6);
        $stub->method('getValue')
            ->willReturn(6);
        $stub->method('getAsString')
            ->willReturn("6");

        $dicehand = new DiceHand();
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $dicehand->add(clone $stub);
        $res = $dicehand->getValues();
        $this->assertEquals([6, 6, 6, 6], $res);
        $res = $dicehand->getString();
        $this->assertEquals(["6", "6", "6", "6"], $res);

        $res = $dicehand->calPoints();
        $this->assertEquals(24, $res);
    }
}
