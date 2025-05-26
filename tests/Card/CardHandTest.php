<?php

namespace App\Test\Card;

use App\Card\CardHand;
use App\Card\DeckOfCards;
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
        $hand = new CardHand(new DeckOfCards);
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        $hand->drawCard(2);
        $res = $hand->showHand();
        $this->assertNotEmpty($res);
    }
}
