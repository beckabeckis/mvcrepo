<?php

namespace App\Test\Card;

use App\Card\DeckOfCards;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DeckOfCardsTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateDeckOfCards(): void
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        $res = $deck->getDeckInOrder();
        $this->assertNotEmpty($res);

        $res = $deck->getDeckInRandom();
        $this->assertNotEmpty($res);
    }

    /**
     * Test if number of cards is correct.
     */
    public function testGetNumOfCard(): void
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        $res = $deck->getNumOfCards();
        $exp = 52;
        $this->assertEquals($res, $exp);

        $deck->drawRandomCard();
        $res = $deck->getNumOfCards();
        $exp = 51;
        $this->assertEquals($res, $exp);
    }

    /**
     * Test if correct card is returned.
     */
    public function testDrawCard(): void
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        $res = $deck->drawRandomCard(1);
        $exp = ["🂲", 2];
        $this->assertEquals($res, $exp);
    }
}
