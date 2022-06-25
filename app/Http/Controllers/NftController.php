<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collections;
use App\Models\User;
use App\Models\NftListings;
use App\Models\NFT;
use App\Models\PurchaceHistory;


class NftController extends Controller
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
        $nftinfo = NFT::where('id', $id)->first();
        $nftinfo->collection_name = Collections::where('id',$nftinfo->collection_id)->pluck('name')->firstOrFail();
        $nftinfo->owner_name = User::where('id',$nftinfo->owner)->pluck('name')->firstOrFail();
        $nftinfo->price = NftListings::where('nft',$nftinfo->id)->pluck('price')->first();

        $nfthistory = PurchaceHistory::where('nft', $id)->get()->reverse();
        foreach ($nfthistory as $record) {
            $record->user_name = User::where('id',$record->user)->pluck('name')->firstOrFail();
        }

        return view('nft_show', compact('nftinfo', 'nfthistory'));
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
