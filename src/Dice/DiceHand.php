<?php

namespace App\Dice;

use App\Dice\Dice;

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
}
