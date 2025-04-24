<?php

namespace App\Card;

class CardGraphic extends Card
{
    /**
     * Constructor to create a Card.
     *
     * @param int    $number  The number of the card.
     * @param string $color   The color of the card.
     */
    public function __construct(int $number, string $color)
    {
        parent::__construct($number, $color);
    }

    /**
     * Method to decide what card should be returned depending on this number.
     *
     * @param array<string> $cardArray array with cards.
     * @return string $card the correct card.
     */
    private function addToCard(array $cardArray): string
    {
        for ($i = 0; $i < 13; $i++) {
            if ($this->number == ($i + 1)) {
                $card = $cardArray[$i];
                return $card;
            }
        }
        return "";
    }

    /**
     * Method to create and return a card from the number and color.
     *
     * @return array<int, int|string> $card the card.
     */
    public function getCard(): array
    {
        $card = "";

        $heartCards = ["🂱", "🂲", "🂳", "🂴", "🂵", "🂶", "🂷", "🂸", "🂹", "🂺", "🂻", "🂽", "🂾"];
        $clubCards = ["🃑", "🃒", "🃓", "🃔", "🃕", "🃖", "🃗", "🃘", "🃙", "🃚", "🃛", "🃝", "🃞"];
        $diamondCards = ["🃁", "🃂", "🃃", "🃄", "🃅", "🃆", "🃇", "🃈", "🃉", "🃊", "🃋", "🃍", "🃎"];
        $spadeCards = ["🂡", "🂢", "🂣", "🂤", "🂥", "🂦", "🂧", "🂨", "🂩", "🂪", "🂫", "🂭", "🂮"];

        switch ($this->color) {
            case "heart":
                $card = $this->addToCard($heartCards);
                break;
            case "club":
                $card = $this->addToCard($clubCards);
                break;
            case 'diamond':
                $card = $this->addToCard($diamondCards);
                break;
            case 'spade':
                $card = $this->addToCard($spadeCards);
                break;
        }
        $currCard = (string)$card;
        $currNum = (int)$this->number;

        $cardArr = [$currCard, $currNum];

        return $cardArr;
    }
}
