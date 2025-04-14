<?php

namespace App\Card;

class CardGraphic extends Card
{
    public function __construct(int $number, string $color)
    {
        parent::__construct($number, $color);
    }

    public function getCard(): string
    {
        $card = "";

        if ($this->color == "heart") {
            switch ($this->number) {
                case 1:
                    $card = "🂱";
                    break;
                case 2:
                    $card = "🂲";
                    break;
                case 3:
                    $card = "🂳";
                    break;
                case 4:
                    $card = "🂴";
                    break;
                case 5:
                    $card = "🂵";
                    break;
                case 6:
                    $card = "🂶";
                    break;
                case 7:
                    $card = "🂷";
                    break;
                case 8:
                    $card = "🂸";
                    break;
                case 9:
                    $card = "🂹";
                    break;
                case 10:
                    $card = "🂺";
                    break;
                case 11:
                    $card = "🂻";
                    break;
                case 12:
                    $card = "🂽";
                    break;
                case 13:
                    $card = "🂾";
                    break;
            }
        } elseif ($this->color == "club") {
            switch ($this->number) {
                case 1:
                    $card = "🃑";
                    break;
                case 2:
                    $card = "🃒";
                    break;
                case 3:
                    $card = "🃓";
                    break;
                case 4:
                    $card = "🃔";
                    break;
                case 5:
                    $card = "🃕";
                    break;
                case 6:
                    $card = "🃖";
                    break;
                case 7:
                    $card = "🃗";
                    break;
                case 8:
                    $card = "🃘";
                    break;
                case 9:
                    $card = "🃙";
                    break;
                case 10:
                    $card = "🃚";
                    break;
                case 11:
                    $card = "🃛";
                    break;
                case 12:
                    $card = "🃝";
                    break;
                case 13:
                    $card = "🃞";
                    break;
            }
        } elseif ($this->color == "diamond") {
            switch ($this->number) {
                case 1:
                    $card = "🃁";
                    break;
                case 2:
                    $card = "🃂";
                    break;
                case 3:
                    $card = "🃃";
                    break;
                case 4:
                    $card = "🃄";
                    break;
                case 5:
                    $card = "🃅";
                    break;
                case 6:
                    $card = "🃆";
                    break;
                case 7:
                    $card = "🃇";
                    break;
                case 8:
                    $card = "🃈";
                    break;
                case 9:
                    $card = "🃉";
                    break;
                case 10:
                    $card = "🃊";
                    break;
                case 11:
                    $card = "🃋";
                    break;
                case 12:
                    $card = "🃍";
                    break;
                case 13:
                    $card = "🃎";
                    break;
            }
        } elseif ($this->color == "spade") {
            switch ($this->number) {
                case 1:
                    $card = "🂡";
                    break;
                case 2:
                    $card = "🂢";
                    break;
                case 3:
                    $card = "🂣";
                    break;
                case 4:
                    $card = "🂤";
                    break;
                case 5:
                    $card = "🂥";
                    break;
                case 6:
                    $card = "🂦";
                    break;
                case 7:
                    $card = "🂧";
                    break;
                case 8:
                    $card = "🂨";
                    break;
                case 9:
                    $card = "🂩";
                    break;
                case 10:
                    $card = "🂪";
                    break;
                case 11:
                    $card = "🂫";
                    break;
                case 12:
                    $card = "🂭";
                    break;
                case 13:
                    $card = "🂮";
                    break;
            }
        }
        return $card;
    }
}
