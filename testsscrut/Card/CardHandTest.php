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
     * Test if one card is drawn correctly.
     */
    public function testDrawCard(): void
    {
        $hand = new CardHand(new DeckOfCards());
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        $res = $hand->drawCard();
        $exp = ["ok"];
        $this->assertEquals($exp, $res);
        $res = $hand->showHand();
        $this->assertNotEmpty($res);
        $res = $hand->getDecksNumOfCards();
        $exp = 51;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test if several cards is drawn correctly.
     */
    public function testDrawCardMore(): void
    {
        $hand = new CardHand(new DeckOfCards());
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        $res = $hand->drawCard(15);
        $exp = ["ok"];
        $this->assertEquals($exp, $res);
        $res = $hand->showHand();
        $this->assertNotEmpty($res);
        $res = $hand->getDecksNumOfCards();
        $exp = 37;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test if too many cards are drawn.
     */
    public function testDrawCardToMany(): void
    {
        $hand = new CardHand(new DeckOfCards());
        $this->assertInstanceOf("\App\Card\CardHand", $hand);

        $res = $hand->drawCard(50);
        $exp = ["ok"];
        $this->assertEquals($exp, $res);
        $res = $hand->drawCard(2);
        $exp = ['notice', 'You took the last off the cards!'];
        $this->assertEquals($exp, $res);
        $res = $hand->drawCard();
        $exp = ['warning', 'No more cards!'];
        $this->assertEquals($exp, $res);
        $res = $hand->getDecksNumOfCards();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
