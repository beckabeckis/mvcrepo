<?php

namespace App\Project;

use App\Card\CardGraphic;

class Table
{
    /**
     * @var array<array>  $table  Array with all the cards.
     */
    private array $table = [];

    /**
     * Constructor to create a Table.
     */
    public function __construct()
    {
        $this->table = [
            [null, null, null, null, null],
            [null, null, null, null, null],
            [null, null, null, null, null],
            [null, null, null, null, null],
            [null, null, null, null, null]
        ];
    }

    /**
     * Method to add a card to a position.
     *
     * @param int $row
     * @param int $col
     * @param CardGraphic $card
     */
    public function insertCard(int $row, int $col, CardGraphic $card): void
    {
        $this->table[$row][$col] = $card;
    }

    /**
     * Method to get the table.
     *
     * @return array<array<CardGraphic>> table
     */
    public function getTable(): array
    {
        return $this->table;
    }

    /**
     * Method to get the table as strings.
     *
     * @return array|array<mixed,array|array<mixed,array<integer,null>>> table as strings
     */
    public function getTableAsString(): array
    {
        $stringTable = [];
        foreach ($this->table as $row) {
            $stringRow = [];
            foreach ($row as $card) {
                $newCard = [null,null];
                if ($card) {
                    $deckCard = $card->getCard();
                    $color = "black";
                    if ($deckCard[2] == "heart" || $deckCard[2] == "diamond") {
                        $color = "red";
                    }
                    $newCard = [(string)$deckCard[0], (string)$color];
                }
                $stringRow[] = $newCard;
            }
            $stringTable[] = $stringRow;
        }
        return $stringTable;
    }

    /**
     * Method check if table is full.
     *
     * @return bool isFull
     */
    public function checkIfFull(): bool
    {
        $isFull = true;

        foreach ($this->table as $row) {
            foreach ($row as $card) {
                if (!$card) {
                    $isFull = false;
                }
            }
        }
        return $isFull;
    }

    /**
    * Method to calculate the final score.
    *
    * @SuppressWarnings(PHPMD)
    * @return array<string> score
    */
    public function calculateScore(): array
    {
        $return = ["Not all cards is in table!"];

        if ($this->checkIfFull()) {
            $tempTable = [
                $this->table[0], $this->table[1], $this->table[2], $this->table[3], $this->table[4],
                [$this->table[0][0], $this->table[1][0], $this->table[2][0], $this->table[3][0], $this->table[4][0]],
                [$this->table[0][1], $this->table[1][1], $this->table[2][1], $this->table[3][1], $this->table[4][1]],
                [$this->table[0][2], $this->table[1][2], $this->table[2][2], $this->table[3][2], $this->table[4][2]],
                [$this->table[0][3], $this->table[1][3], $this->table[2][3], $this->table[3][3], $this->table[4][3]],
                [$this->table[0][4], $this->table[1][4], $this->table[2][4], $this->table[3][4], $this->table[4][4]],
            ];

            $pointsAme = 0;
            $pointsEng = 0;

            foreach ($tempTable as $row) {
                $card1 = $row[0]->getCard();
                $card2 = $row[1]->getCard();
                $card3 = $row[2]->getCard();
                $card4 = $row[3]->getCard();
                $card5 = $row[4]->getCard();

                $values = [$card1[1], $card2[1], $card3[1], $card4[1], $card5[1]];
                sort($values);

                $countValues = array_count_values($values);

                $amePointsToAdd = 0;
                $engPointsToAdd = 0;

                // Check Straigth Flush
                if ($card1[2] === $card2[2] &&
                    $card1[2] === $card3[2] &&
                    $card1[2] === $card4[2] &&
                    $card1[2] === $card5[2]) {
                    $amePointsToAdd = 20;
                    $engPointsToAdd = 5;
                    if ($values[0] == 1 && //check royal flush first
                        $values[1] == 10 &&
                        $values[2] == 11 &&
                        $values[3] == 12 &&
                        $values[4] == 13) {
                        $amePointsToAdd = 100;
                        $engPointsToAdd = 30;
                    } elseif (($values[0] + 1) == $values[1] && // Straight fulsh
                        ($values[1] + 1) == $values[2] &&
                        ($values[2] + 1) == $values[3] &&
                        ($values[3] + 1) == $values[4]) {
                        $amePointsToAdd = 75;
                        $engPointsToAdd = 30;
                    }
                } elseif (array_search(4, $countValues)) { // check four of a kind
                    $amePointsToAdd = 50;
                    $engPointsToAdd = 16;
                } elseif (array_search(3, $countValues) && array_search(2, $countValues)) { // check full house
                    $amePointsToAdd = 25;
                    $engPointsToAdd = 10;
                } elseif ($values[0] == 1 && // check straight
                    $values[1] == 10 &&
                    $values[2] == 11 &&
                    $values[3] == 12 &&
                    $values[4] == 13 ||
                    ($values[0] + 1) == $values[1] &&
                    ($values[1] + 1) == $values[2] &&
                    ($values[2] + 1) == $values[3] &&
                    ($values[3] + 1) == $values[4]) {
                    $amePointsToAdd = 15;
                    $engPointsToAdd = 12;
                } elseif (array_search(3, $countValues)) { // check three of a kind
                    $amePointsToAdd = 10;
                    $engPointsToAdd = 6;
                } elseif (array_search(2, array_count_values($countValues))) { // check two pairs
                    $amePointsToAdd = 5;
                    $engPointsToAdd = 3;
                } elseif (array_search(2, $countValues)) { // check one pair
                    $amePointsToAdd = 2;
                    $engPointsToAdd = 1;
                }

                $pointsAme += $amePointsToAdd;
                $pointsEng += $engPointsToAdd;
            }
            $ameWin = "Du förlorade enligt det Amerikanska poängsystemet!";
            if ($pointsAme >= 200) {
                $ameWin = "Du VANN enligt det Amerikanska poängsystemet!";
            }
            $engWin = "Du förlorade enligt det Engelska poängsystemet!";
            if ($pointsEng >= 70) {
                $engWin = "Du VANN enligt det Engelska poängsystemet!";
            }
            $return = [(string)$pointsAme, (string)$pointsEng, $ameWin, $engWin];
        }
        return $return;
    }
}
