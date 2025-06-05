<?php

namespace App\Test\Card;

use App\Card\BankCardHand;
use App\Card\DeckOfCards;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class BankCardHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateBankCardHand(): void
    {
        $stub = $this->createMock(DeckOfCards::class);

        $hand = new BankCardHand($stub);
        $this->assertInstanceOf("\App\Card\BankCardHand", $hand);
    }

    /**
     * Test if a card is drawn correctly.
     */
    public function testPlayGame(): void
    {
        $stub = $this->createMock(DeckOfCards::class);
        $stub->method('drawRandomCard')
            ->willReturn(["🃒", 2]);

        $hand = new BankCardHand($stub);
        $this->assertInstanceOf("\App\Card\BankCardHand", $hand);

        $hand->playGame(-1);
        $res = $hand->showHand();
        $this->assertNotEmpty($res);
    }

    /**
     * Test if totalPoints is correct.
     */
    public function testTotalPoints(): void
    {
        $stub = $this->createMock(DeckOfCards::class);
        $stub->method('drawRandomCard')
            ->willReturn(["🃒", 2]);

        $hand = new BankCardHand($stub);
        $this->assertInstanceOf("\App\Card\BankCardHand", $hand);

        $hand->playGame(2);
        $res = $hand->getTotalPoints();
        $exp = 2;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test if addPoint adds to totalPoints.
     */
    public function testaddPoints(): void
    {
        $stub = $this->createMock(DeckOfCards::class);

        $hand = new BankCardHand($stub);
        $this->assertInstanceOf("\App\Card\BankCardHand", $hand);

        $hand->addPoints(5);
        $res = $hand->getTotalPoints();
        $exp = 5;
        $this->assertEquals($exp, $res);
    }
}
