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
     * @return array<string> array with okey or error message.
     */
    public function drawCard(int $num = 1): array
    {
        $cardsInDeck = $this->deck->getNumOfCards();
        $return = ["ok"];

        if ($cardsInDeck == 0) {
            $return = ['warning', 'No more cards!'];
        } elseif ($cardsInDeck <= $num) {
            for ($i = 0; $i < $cardsInDeck; $i++) {
                $card = $this->deck->drawRandomCard();
                $this->hand[] = (string)$card[0];
            }
            $return = ['notice', 'You took the last off the cards!'];
        } elseif ($cardsInDeck > $num) {
            for ($i = 0; $i < $num; $i++) {
                $card = $this->deck->drawRandomCard();
                $this->hand[] = (string)$card[0];
            }
        }
        return $return;
    }

    /**
     * Method to return all the cards in a hand.
     *
     * @return array<string> Array with all the cards in the hand.
     */
    public function showHand(): array
    {
        return $this->hand;
    }

    /**
     * Method to return the deck.
     *
     * @return DeckOfCards the deck.
     */
    public function getDeck(): DeckOfCards
    {
        return $this->deck;
    }

    /**
     * Method to return number of cards in the deck.
     *
     * @return int num of cards let in deck.
     */
    public function getDecksNumOfCards(): int
    {
        return $this->deck->getNumOfCards();
    }
}
