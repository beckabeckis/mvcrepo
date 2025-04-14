<?php

namespace App\Card;

class Card
{
    /**
     * @var integer $number  The number of the card.
     * @var string  $color   The color of the card.
     */
    protected $number = 0;
    protected $color = "";

    /**
     * Constructor to create a Card.
     *
     * @param null|int    $number  The number of the card.
     * @param null|string $color   The color of the card.
     */
    public function __construct(int $number = null, string $color = null)
    {
        $this->number = $number;
        $this->color = $color;
    }

    /**
     * Method to create and return a card from the number and color.
     *
     * @return string $card the card.
     */
    public function getCard(): string
    {
        $card = "[";

        switch ($this->color) {
            case "heart":
                $card = $card . "♥";
                break;
            case "club":
                $card = $card . "♣";
                break;
            case "diamond":
                $card = $card . "♦";
                break;
            case "spade":
                $card = $card . "♠";
                break;
        }

        switch ($this->number) {
            case 1:
                $card = $card . "A]";
                break;
            case 2:
                $card = $card . "2]";
                break;
            case 3:
                $card = $card . "3]";
                break;
            case 4:
                $card = $card . "1]";
                break;
            case 5:
                $card = $card . "1]";
                break;
            case 6:
                $card = $card . "6]";
                break;
            case 7:
                $card = $card . "1]";
                break;
            case 8:
                $card = $card . "1]";
                break;
            case 9:
                $card = $card . "9]";
                break;
            case 10:
                $card = $card . "10]";
                break;
            case 11:
                $card = $card . "Kn]";
                break;
            case 12:
                $card = $card . "Q]";
                break;
            case 13:
                $card = $card . "K]";
                break;
        }

        return $card;
    }
}
