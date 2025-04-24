<?php

namespace App\Card;

class PlayerCardHand extends CardHand
{
    private int $totalPoints = 0;

    // public function __construct(DeckOfCards $deck)
    // {
    //     parent::__construct($deck);
    // }

    /**
     * Method to draw one or more cards from the deck and add points to total.
     *
     * @return int The number of the card.
     */
    public function drawPlayerCard(): int
    {
        $card = $this->deck->drawRandomCard();
        $this->hand[] = (string)$card[0];
        if ($card[1] == 1) {
            return -1;
        }
        $this->totalPoints += (int)$card[1];
        return (int)$card[1];
    }

    /**
     * Method to add points.
     *
     * @param int $points to add.
     */
    public function addPoints(int $points): void
    {
        $this->totalPoints += $points;
    }

    /**
     * Method to draw one or more cards from the deck and add points to total.
     *
     * @return int The number of the card.
     */
    public function getTotalPoints(): int
    {
        return $this->totalPoints;
    }
}
