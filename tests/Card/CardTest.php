<?php

namespace App\Test\Card;

use App\Card\Card;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCard(): void
    {
        $card = new Card(4, "heart");
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getNumber();
        $this->assertNotEmpty($res);

        $res = $card->getColor();
        $this->assertNotEmpty($res);
    }

    /**
     * Test if correct card is returned.
     */
    public function testGetCard(): void
    {
        $card = new Card(4, "heart");
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getCard();
        $exp = ["[♥4]", 4];
        $this->assertEquals($res, $exp);
    }
}
