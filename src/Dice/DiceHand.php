<?php

namespace App\Dice;

use App\Dice\Dice;
use App\Dice\DiceGraphic;

class DiceHand
{
    /** @var array<Dice> */
    private $hand = [];

    /**
     * Method to add a Dice class to the hand.
     *
     * @param Dice $die A dice object.
     */
    public function add(Dice $die): void
    {
        $this->hand[] = $die;
    }

    /**
     * Method to add several Dice classes to the hand, mixed dices.
     *
     * @param int $num num of dices.
     */
    public function addDicesMixed(int $num): void
    {
        for ($i = 1; $i <= $num; $i++) {
            $dice = new Dice();
            if ($i % 2 === 1) {
                $dice = new DiceGraphic();
            }
            $this->add($dice);
        }
    }

    /**
     * Method to roll the Dice.
     */
    public function roll(): void
    {
        foreach ($this->hand as $die) {
            $die->roll();
        }
    }

    /**
     * Method to get how many dices the hand has.
     *
     * @return int how many dices.
     */
    public function getNumberDices(): int
    {
        return count($this->hand);
    }

    /**
     * Method to get all the values of the dices.
     *
     * @return array<int> array with all the values of the dices.
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getValue();
        }
        return $values;
    }

    /**
     * Method to get all the values of the dices sumed upp.
     *
     * @return int Sum off all the values.
     */
    public function sum(): int
    {
        $sum = 0;
        foreach ($this->hand as $die) {
            $sum += $die->getValue();
        }
        return $sum;
    }

    /**
     * Method to get all the values of the dices as strings.
     *
     * @return array<string> array with all the values of the dices as strings.
     */
    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getAsString();
        }
        return $values;
    }
    
    /**
     * Method to calculate total points and send back -1 if there is a value that is 1.
     *
     * @return int total points.
     */
    public function calPoints(): int
    {
        $points = 0;

        $valuesFun = $this->getValues();
        foreach ($valuesFun as $value) {
            if ($value === 1) {
                $points = -1;
                break;
            }
            $points += $value;
        }

        return $points;
    }
}
