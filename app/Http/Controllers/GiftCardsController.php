<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GiftCard;

class GiftCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $giftcards = GiftCard::all();
        function giftCard($lenght=16) {
            $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
            $res = "";
            for ($i = 0; $i < $lenght; $i++) {
                $res .= $chars[mt_rand(0, strlen($chars)-1)];
            }
            return $res;
        }
        $card_code = giftCard(16);
        return view('giftcards.index', ['card_code'=> $card_code, 'giftcards' => $giftcards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        GiftCard::create($request->all());
        return redirect()->route('giftcards.index');
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
        GiftCard::find($id)->delete();
        return redirect()->route('giftcards.index');
    }
}
