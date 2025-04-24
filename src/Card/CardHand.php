<?php

namespace App\Card;

use App\Card\DeckOfCards;

class CardHand
{
    /**
     * @var array<string>  $hand  Array with all the cards in the hand.
     * @var object $deck  The deck.
     */
    public array $hand = [];
    public DeckOfCards $deck;

    /**
     * Constructor to create a CardHand.
     */
    public function __construct(DeckOfCards $deck)
    {
        $this->deck = $deck;
    }

    /**
     * Method to draw one or more cards from the deck.
     *
     * @param int $num Numbers of cards to be drawn.
     */
    public function drawCard(int $num = 1): void
    {
        for ($i = 0; $i <= ($num - 1); $i++) {
            $card = $this->deck->drawRandomCard();
            $this->hand[] = (string)$card[0];
        }
    }

    /**
     * Method to return all the cards in a hand.
     *
     * @return array<string> Array with all the cards in the hand.
     */
    public function showCards(): array
    {
        return $this->hand;
    }

    /**
     * Method to retrun the deck.
     *
     * @return object the object of the DeckOfCards class.
     */
    public function getDeck(): object
    {
        return $this->deck;
    }
}
