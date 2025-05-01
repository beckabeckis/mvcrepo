<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class PlayerCardHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreatePlayerCardHand(): void
    {
        $stub = $this->createMock(DeckOfCards::class);

        $hand = new PlayerCardHand($stub);
        $this->assertInstanceOf("\App\Card\PlayerCardHand", $hand);
    }

    /**
     * Test if a card is drawn correctly.
     */
    public function testDrawPlayerCard(): void
    {
        $stub = $this->createMock(DeckOfCards::class);
        $stub->method('drawRandomCard')
            ->willReturn(["🂡", 1]);

        $hand = new PlayerCardHand($stub);
        $this->assertInstanceOf("\App\Card\PlayerCardHand", $hand);

        $hand->drawPlayerCard(-1);
        $res = $hand->showCards();
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

        $hand = new PlayerCardHand($stub);
        $this->assertInstanceOf("\App\Card\PlayerCardHand", $hand);

        $hand->drawPlayerCard(2);
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

        $hand = new PlayerCardHand($stub);
        $this->assertInstanceOf("\App\Card\PlayerCardHand", $hand);

        $hand->addPoints(5);
        $res = $hand->getTotalPoints();
        $exp = 5;
        $this->assertEquals($exp, $res);
    }
}
