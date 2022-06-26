<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collections;
use App\Models\NFT;
use App\Models\User;
use App\Models\PurchaceHistory;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function show_new($id)
    {
        $collection = Collections::where('id', $id)->firstOrFail();
        $collection->open_count = NFT::where('collection_id', $id)->whereNull('owner')->count();

        return view('show_open_collection', compact('collection'));
    }

    public function buy_new($id) {

        $collection = Collections::where('id', $id)->firstOrFail();
        $nft = NFT::where('collection_id', $id)->whereNull('owner')->inRandomOrder()->firstOrFail();
        $buyer = User::where('id', Auth::user()->id)->firstOrFail();

        if ($buyer->balance >= $collection->initial_price) {
            $buyer->balance = $buyer->balance - $collection->initial_price;
            $buyer->save();
            $nft->owner = $buyer->id;
            $nft->save();

            $record = new PurchaceHistory;
            $record->price = $collection->initial_price;
            $record->user = $buyer->id;
            $record->nft = $nft->id;
            $record->save();

            return back()->with('success','You have purchaced the NFT!');
        } else {
            return back()->with('fail','You do not have enough money for that.');
        }


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
}
