<?php

namespace App\Test\Project;

use App\Project\Table;
use App\Card\CardGraphic;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class TableTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateTable(): void
    {
        $table = new Table();
        $this->assertInstanceOf("\App\Project\Table", $table);
    }

    /**
     * Test if inserCard and getTableAsString methods works.
     */
    public function testInsertCard(): void
    {
        $card = new CardGraphic(1, "heart");

        $table = new Table();

        $table->insertCard(3, 2, $card);
        $tableArrString = $table->getTableAsString();
        $res = $tableArrString[3][2];

        $exp = ["🂱", "red"];
        $this->assertEquals($exp, $res);
    }

    /**
    * Test if getTable method works.
    */
    public function testGetTable(): void
    {
        $card = new CardGraphic(1, "heart");

        $table = new Table();

        $table->insertCard(3, 2, $card);
        $tableArr = $table->getTable();
        $res = $tableArr[3][2];

        $exp = $card;
        $this->assertEquals($exp, $res);

        $res = $table->checkIfFull();
        $this->assertFalse($res);
    }

    /**
     * Test if testCalculateScore method works.
     */
    public function testCalculateScore(): void
    {
        // check royal straight flush
        $card00 = new CardGraphic(12, "heart"); // check three of a kind
        $card01 = new CardGraphic(13, "heart"); // check one pair
        $card02 = new CardGraphic(1, "heart"); // check straight with highest numbers
        $card03 = new CardGraphic(11, "heart"); // check straigth
        $card04 = new CardGraphic(10, "heart"); // check two pair

        // check straight flush
        $card10 = new CardGraphic(11, "spade"); // check three of a kind
        $card11 = new CardGraphic(9, "spade"); // check one pair
        $card12 = new CardGraphic(10, "spade"); // check straight with highest numbers
        $card13 = new CardGraphic(8, "spade"); // check straigth
        $card14 = new CardGraphic(7, "spade"); // check two pair

        // check flush
        $card20 = new CardGraphic(9, "diamond"); // check three of a kind
        $card21 = new CardGraphic(11, "diamond"); // check one pair
        $card22 = new CardGraphic(11, "diamond"); // check straight with highest numbers
        $card23 = new CardGraphic(10, "diamond"); // check straigth
        $card24 = new CardGraphic(7, "diamond"); // check two pair

        // check four of a kind
        $card30 = new CardGraphic(9, "spade"); // check three of a kind
        $card31 = new CardGraphic(9, "diamond"); // check one pair
        $card32 = new CardGraphic(13, "heart"); // check straight with highest numbers
        $card33 = new CardGraphic(9, "spade"); // check straigth
        $card34 = new CardGraphic(9, "club"); // check two pair

        //check full house
        $card40 = new CardGraphic(9, "club"); // check three of a kind
        $card41 = new CardGraphic(12, "diamond"); // check one pair
        $card42 = new CardGraphic(12, "spade"); // check straight with highest numbers
        $card43 = new CardGraphic(12, "club"); // check straigth
        $card44 = new CardGraphic(9, "heart"); // check two pair


        $table = new Table();


        $table->insertCard(0, 0, $card00);
        $table->insertCard(0, 1, $card01);
        $table->insertCard(0, 2, $card02);
        $table->insertCard(0, 3, $card03);
        $table->insertCard(0, 4, $card04);

        $table->insertCard(1, 0, $card10);
        $table->insertCard(1, 1, $card11);
        $table->insertCard(1, 2, $card12);
        $table->insertCard(1, 3, $card13);
        $table->insertCard(1, 4, $card14);

        $table->insertCard(2, 0, $card20);
        $table->insertCard(2, 1, $card21);
        $table->insertCard(2, 2, $card22);
        $table->insertCard(2, 3, $card23);
        $table->insertCard(2, 4, $card24);

        $table->insertCard(3, 0, $card30);
        $table->insertCard(3, 1, $card31);
        $table->insertCard(3, 2, $card32);
        $table->insertCard(3, 3, $card33);
        $table->insertCard(3, 4, $card34);

        $table->insertCard(4, 0, $card40);
        $table->insertCard(4, 1, $card41);
        $table->insertCard(4, 2, $card42);
        $table->insertCard(4, 3, $card43);
        $table->insertCard(4, 4, $card44);

        $res = $table->calculateScore();

        $exp = ["317", "125", "Du VANN enligt det Amerikanska poängsystemet!", "Du VANN enligt det Engelska poängsystemet!"];
        $this->assertEquals($exp, $res);

        $res = $table->checkIfFull();
        $this->assertTrue($res);
    }
}
