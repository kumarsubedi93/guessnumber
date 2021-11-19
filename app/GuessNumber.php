<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuessNumber extends Model
{
    const MORE = 'more';
    const LESS = 'less';
    const BINGO = 'bingo';

    protected $table = "guessnumber_history";

    protected $fillable = [
        'game_id', 'move_number', 'guess_value', 'generated_value', 'computer_answer'
    ];

    protected $primaryKey = 'game_id';

}
