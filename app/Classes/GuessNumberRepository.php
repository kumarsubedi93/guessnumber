<?php

namespace App\Classes;

use App\GuessNumber;
use App\Interfaces\GuessNumberInterface;

class GuessNumberRepository implements GuessNumberInterface
{
    public function getMoveNumber()
    {
        $move = session()->get('usermove');
        if ($move) {
            $movei = $move + 1;
            session()->forget('usermove');
            session()->put('usermove', $movei);
            return $movei;
        }
        session()->put('usermove', 1);
        return 1;
    }

    public function computerGenerateResult($userInput, $computerGuess)
    {
        $userInput = (int)$userInput;
        if ($userInput == $computerGuess) {
            return GuessNumber::BINGO;
        } else if ($userInput > $computerGuess) {
            return GuessNumber::LESS;
        } else {
            return GuessNumber::MORE;
        }
    }

    public function computerGuessNumber($min = 0, $max = 100)
    {
        return rand($min, $max);
    }


    public function storeGuessResult($data)
    {
        return GuessNumber::create($data);
    }
}
