<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\GiftCard;
use App\Transaction;
class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->wallet->transactions;
        return view('index.transactions.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // show user balance in index
    public function user_balance() {
        $user = Auth::user();
        $transactions = $user->wallet->transactions()->latest()->paginate(6);
        return view('index.balance', ['transactions' => $transactions]); 
    }

    public function add_balance(Request $request) {
        $user_id = Auth::id();
        $card= $request->card;
        $card = DB::table('gift_cards')->where(['card' => $card, 'status'=> 0])->first();
        if($card){
            GiftCard::where('card', $request->card)->update(['status' =>1, 'user_id' => $user_id]);
            $card_value = $card->value;
            
            $user=Auth::user();
            $user_wallet = $user->wallet;
            $user_wallet->balance = $user_wallet->balance + $card_value;
            $user_wallet->save();
            $user_balance = $user_wallet->balance;
            
            $transaction =new \App\Transaction([
                'transaction' => $card_value,
                'balance_after' => $user_balance,
                'info'          => $card->card
                ]);
            $user_wallet->transactions()->save($transaction);
                
            session()->flash('success', 'the card has been charged successfully');
            return redirect()->route('index.balance');
        }
        session()->flash('error', 'the card is not valid');
        return redirect()->route('index.balance');
    }

}
