<?php

namespace App\Card;

class Card
{
    /**
     * @var integer $number  The number of the card.
     * @var string  $color   The color of the card.
     */
    protected int $number = 0;
    protected string $color = "";

    /**
     * Constructor to create a Card.
     *
     * @param int    $number  The number of the card.
     * @param string $color   The color of the card.
     */
    public function __construct(int $number, string $color)
    {
        $this->number = $number;
        $this->color = $color;
    }

    /**
     * Method to create and return a card from the number and color.
     *
     * @return array<int, int|string> $card the card.
     */
    public function getCard(): array
    {
        $card = "[";

        $colors = ["heart", "club", "diamond", "spade"];
        $colorIcons = ["♥", "♣", "♦", "♠"];
        $colorCount = 0;

        foreach ($colors as $color) {
            if ($this->color == $color) {
                $card = $card . $colorIcons[$colorCount];
            }
            $colorCount++;
        }

        $numbers = ["A]", "2]", "3]", "4]", "5]", "6]", "7]", "8]", "9]", "10]", "Kn]", "Q]", "K]"];

        for ($i = 0; $i < 13; $i++) {
            if ($this->number == ($i + 1)) {
                $card = $card . $numbers[$i];
            }
        }

        $currCard = (string)$card;
        $currNum = (int)$this->number;

        $cardArr = [$currCard, $currNum];

        return $cardArr;
    }
}
