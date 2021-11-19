<?php

namespace App\Console\Commands;

use App\Interfaces\GuessNumberInterface;
use Illuminate\Console\Command;

class GuessNumber extends Command
{
    private $guessnumber;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guess:number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Browser game Guess a number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GuessNumberInterface $guessNumber)
    {
        parent::__construct();
        $this->guessnumber = $guessNumber;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userGuess = $this->ask("Guess your number");
        if (ctype_digit($userGuess) && $userGuess > 0 && $userGuess < 100) {
            $computerGuess = $this->guessnumber->computerGuessNumber();
            $computerResult = $this->guessnumber->computerGenerateResult($userGuess, $computerGuess);
            $storePayload = [
                'move_number' => 1,
                'guess_value' => $userGuess,
                'generated_value' => $computerGuess,
                'computer_answer' => $computerResult
            ];
            $this->guessnumber->storeGuessResult($storePayload);
            $this->info('The guess result is ' . $computerResult);
        } else {
            $this->warn("Please enter number between 0  to 100");
        }
    }
}
