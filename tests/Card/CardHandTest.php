<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class CardHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCardHand(): void
    {
        $stub = $this->createMock(DeckOfCards::class);

        $hand = new CardHand($stub);
        $this->assertInstanceOf("\App\Card\CardHand", $hand);
    }

    /**
     * Test if a card is drawn correctly.
     */
    public function testDrawCard(): void
    {
        $stub = $this->createMock(DeckOfCards::class);
        $stub->method('drawRandomCard')
            ->willReturn(["🃒", 2]);

        $hand = new CardHand($stub);
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        $hand->drawCard(2);
        $res = $hand->showCards();
        $this->assertNotEmpty($res);
    }

    /**
     * Test if a card is drawn correctly.
     */
    public function testDrawSpecificCard(): void
    {
        $stub = $this->createMock(DeckOfCards::class);
        $stub->method('drawRandomCard')
            ->willReturn(["🃒", 2]);

        $hand = new CardHand($stub);
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        $hand->drawCard();
        $res = $hand->showCards();
        $exp = ["🃒"];
        $this->assertEquals($res, $exp);
    }
}
