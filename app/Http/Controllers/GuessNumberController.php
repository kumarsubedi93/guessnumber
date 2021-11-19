<?php

namespace App\Http\Controllers;


use App\GuessNumber;
use App\Interfaces\GuessNumberInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GuessNumberController extends Controller
{
    protected $guessNumberRepo;

    public function __construct(GuessNumberInterface $guessNumberRepo)
    {
        $this->guessNumberRepo = $guessNumberRepo;
    }

    public function getGuessHistory(Request $request)
    {
        if ($request->ajax()) {
            $data = GuessNumber::select('game_id', 'move_number', 'guess_value', 'generated_value', 'computer_answer')->orderBy('game_id', 'desc');
            return Datatables::of($data)->make(true);
        }
        return view('history');
    }

    public function storeGuessResult(Request $request)
    {
        $this->validate($request, [
            'guess_number' => 'required|integer|min:0|max:100'
        ]);
        $userGuess = $request->get('guess_number');
        $computerGuessNumber = $this->guessNumberRepo->computerGuessNumber();
        $computerAns = $this->guessNumberRepo->computerGenerateResult($userGuess, $computerGuessNumber);
        $preparePayload = [
            'move_number' => $this->guessNumberRepo->getMoveNumber(),
            'guess_value' => $userGuess,
            'generated_value' => $computerGuessNumber,
            'computer_answer' => $computerAns
        ];
        $response = $this->guessNumberRepo->storeGuessResult($preparePayload);
        return response()->json($response, 200);
    }

    public function clearMove()
    {
        session()->forget('usermove');
    }

}
