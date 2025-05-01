<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{
    /**
     * @var array<CardGraphic> $deck  Array with all the cards in a deck.
     */
    private $deck = [];

    /**
     * Constructor to create a DeckOfCards.
     *
     */
    public function __construct()
    {
        $this->deck = [
            new CardGraphic(1, "heart"),
            new CardGraphic(2, "heart"),
            new CardGraphic(3, "heart"),
            new CardGraphic(4, "heart"),
            new CardGraphic(5, "heart"),
            new CardGraphic(6, "heart"),
            new CardGraphic(7, "heart"),
            new CardGraphic(8, "heart"),
            new CardGraphic(9, "heart"),
            new CardGraphic(10, "heart"),
            new CardGraphic(11, "heart"),
            new CardGraphic(12, "heart"),
            new CardGraphic(13, "heart"),
            new CardGraphic(1, "club"),
            new CardGraphic(2, "club"),
            new CardGraphic(3, "club"),
            new CardGraphic(4, "club"),
            new CardGraphic(5, "club"),
            new CardGraphic(6, "club"),
            new CardGraphic(7, "club"),
            new CardGraphic(8, "club"),
            new CardGraphic(9, "club"),
            new CardGraphic(10, "club"),
            new CardGraphic(11, "club"),
            new CardGraphic(12, "club"),
            new CardGraphic(13, "club"),
            new CardGraphic(1, "diamond"),
            new CardGraphic(2, "diamond"),
            new CardGraphic(3, "diamond"),
            new CardGraphic(4, "diamond"),
            new CardGraphic(5, "diamond"),
            new CardGraphic(6, "diamond"),
            new CardGraphic(7, "diamond"),
            new CardGraphic(8, "diamond"),
            new CardGraphic(9, "diamond"),
            new CardGraphic(10, "diamond"),
            new CardGraphic(11, "diamond"),
            new CardGraphic(12, "diamond"),
            new CardGraphic(13, "diamond"),
            new CardGraphic(1, "spade"),
            new CardGraphic(2, "spade"),
            new CardGraphic(3, "spade"),
            new CardGraphic(4, "spade"),
            new CardGraphic(5, "spade"),
            new CardGraphic(6, "spade"),
            new CardGraphic(7, "spade"),
            new CardGraphic(8, "spade"),
            new CardGraphic(9, "spade"),
            new CardGraphic(10, "spade"),
            new CardGraphic(11, "spade"),
            new CardGraphic(12, "spade"),
            new CardGraphic(13, "spade"),
        ];
    }

    /**
     * Method to return the deck in order.
     *
     * @return array<string> the deck in order.
     */
    public function getDeckInOrder(): array
    {
        $cards = [];
        $numOfCards = (count($this->deck));
        for ($i = 0; $i <= ($numOfCards - 1); $i++) {
            $card = $this->deck[$i]->getCard();
            $cards[$i] = (string)$card[0];
        }
        return $cards;
    }

    /**
     * Method to return the deck in disorder.
     *
     * @return array<string> the deck in disorder.
     */
    public function getDeckInRandom(): array
    {
        $randomDeck = $this->deck;
        shuffle($randomDeck);
        $cards = [];
        $numOfCards = (count($randomDeck));
        for ($i = 0; $i <= ($numOfCards - 1); $i++) {
            $card = $randomDeck[$i]->getCard();
            $cards[$i] = (string)$card[0];
        }
        return $cards;
    }

    /**
     * Method to return a random card and also remove the card from the deck.
     *
     * @param int $randomValue A value if user wants a specific card (or for testing), if null it will be a random card.
     * @return array<int, int|string> random card from the deck.
     */
    public function drawRandomCard(int $randomValue = -1): array
    {
        $randomCard = $this->deck[0];
        if ((count($this->deck) > 1)) {
            if ($randomValue == -1) {
                $randomValue = random_int(0, (count($this->deck) - 1));
            }
            $randomCard = $this->deck[$randomValue];
            array_splice($this->deck, $randomValue, 1);
        }
        return $randomCard->getCard();
    }

    /**
     * Method to returning the number of cards in the deck.
     *
     * @return int number of cards in the deck.
     */
    public function getNumOfCards(): int
    {
        return count($this->deck);
    }
}
