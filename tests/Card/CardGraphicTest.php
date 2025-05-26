<?php

namespace App\Test\Card;

use App\Card\CardGraphic;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCardGraphic(): void
    {
        $card = new CardGraphic(4, "heart");
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $res = $card->getNumber();
        $this->assertNotEmpty($res);

        $res = $card->getColor();
        $this->assertNotEmpty($res);
    }

    /**
     * Test if correct card is returned if its a heart.
     */
    public function testGetCardHeart(): void
    {
        $card = new CardGraphic(4, "heart");
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getCard();
        $exp = ["🂴", 4];
        $this->assertEquals($res, $exp);
    }

    /**
     * Test if correct card is returned if its a club.
     */
    public function testGetCardClub(): void
    {
        $card = new CardGraphic(13, "club");
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getCard();
        $exp = ["🃞", 13];
        $this->assertEquals($res, $exp);
    }

    /**
     * Test if correct card is returned if its a diamond.
     */
    public function testGetCardDiamond(): void
    {
        $card = new CardGraphic(1, "diamond");
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getCard();
        $exp = ["🃁", 1];
        $this->assertEquals($res, $exp);
    }

    /**
     * Test if correct card is returned if its a spade.
     */
    public function testGetCardSpade(): void
    {
        $card = new CardGraphic(11, "spade");
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getCard();
        $exp = ["🂫", 11];
        $this->assertEquals($res, $exp);
    }
}
