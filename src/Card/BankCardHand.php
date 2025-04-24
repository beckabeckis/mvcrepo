<?php

namespace App\Card;

class BankCardHand extends CardHand
{
    private int $totalPoints = 0;

    public function __construct(DeckOfCards $deck)
    {
        parent::__construct($deck);
    }

    /**
     * Method to get total points.
     *
     * @return int Total points.
     */
    public function getTotalPoints(): int
    {
        return $this->totalPoints;
    }

    /**
     * Method to draw one or more cards from the deck and add points to total.
     *
     * @return int The number of the card.
     */
    public function drawBankCard(): int
    {
        $card = $this->deck->drawRandomCard();
        $this->hand[] = (string)$card[0];
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
     * Method for bank to play a game.
     */
    public function playGame(): void
    {
        $randomValue = random_int(3, 10);

        for ($i = 1; $i < $randomValue; $i++) {
            if ($this->totalPoints < 21) {
                $card = $this->deck->drawRandomCard();
                $this->hand[] = (string)$card[0];
                $this->totalPoints += (int)$card[1];
            }
        }
    }
}
