<?php

namespace App\Interfaces;

interface GuessNumberInterface
{
    public function computerGuessNumber($min = 0, $max = 100);

    public function storeGuessResult($data);

    public function getMoveNumber();

    public function computerGenerateResult($userGuess, $computerInput);

}
