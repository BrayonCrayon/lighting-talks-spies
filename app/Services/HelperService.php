<?php

namespace App\Services;

class HelperService
{

    public function add($leftNumber, $rightNumber)
    {
        return $leftNumber + $rightNumber;
    }

    public function sub($leftNumber, $rightNumber)
    {
        return $leftNumber - $rightNumber;
    }

    public function multiply($leftNumber, $rightNumber)
    {
        return $leftNumber * $rightNumber;
    }

    public function endOfTheWorldCalculation($leftNumber, $rightNumber)
    {
        return $this->multiply($this->sub($this->add($leftNumber, $rightNumber) * 12, 1966), 42);
    }

    public function activeBackgroundGnome()
    {
        return "Nom nom nom nom!!";
    }

}
