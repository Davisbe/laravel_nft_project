<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NftListings;
use App\Models\NFT;
use App\Models\PurchaceHistory;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function new_listing(Request $request, $id)
    {
        $nft = NFT::where('id', $id)->first();
        if (!Auth::check() && (Auth::user()->id != $nft->owner)) {
            return back();
        }

        $request->validate([
            'price'=>'required|max:9999999999.99|min:1|numeric'
        ]);

        $nft->nft_listings()->create([
            'user'=>$nft->owner,
            'price'=>$request->price
        ]);

        if (true) {
            return back()->with('success', 'NFT has been listed!');
        }
        else {
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function update_listing(Request $request, $id)
    {
        $nft = NFT::where('id', $id)->first();
        if (!Auth::check() && (Auth::user()->id != $nft->owner)) {
            return back();
        }

        $request->validate([
            'price'=>'required|max:9999999999.99|min:1|numeric'
        ]);

        $listing = NftListings::where('nft', $nft->id)->first();
        $listing->price = $request->price;
        $listing->save();

        if ($listing) {
            return back()->with('success', 'Listing price has been updated!');
        }
        else {
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    public function transaction($id) {

        $nft = NFT::where('id', $id)->firstOrFail();
        $listing = NftListings::where('nft', $nft->id)->firstOrFail();
        $owner = User::where('id', $nft->owner)->firstOrFail();
        $buyer = User::where('id', Auth::user()->id)->firstOrFail();

        if ($buyer->id != $owner->id) {
            if ($listing->price <= $buyer->balance) {
                $buyer->balance = $buyer->balance - $listing->price;
                $buyer->save();
                $nft->owner = $buyer->id;
                $nft->save();

                $record = new PurchaceHistory;
                $record->price = $listing->price;
                $record->user = $buyer->id;
                $record->nft = $nft->id;
                $record->save();

                $listing->delete();

                return back()->with('success','You have purchaced the NFT!');
            }
            else {
                return back()->with('fail','You do not have enough money for that.');
            }
        }
        else {
            return back()->with('fail','Were you... trying to buy your own NFT?');
        }
    }

    public function remove($id) {
        $nft = NFT::where('id', $id)->firstOrFail();
        $listing = NftListings::where('nft', $nft->id)->firstOrFail();

        if ($nft->owner == Auth::user()->id) {
            if ($listing->delete()) {
                return back()->with('success','Listing has been removed');
            }
            else {
                return back()->with('fail','Something went wrong, try again later.');
            }
        } else {
            return back()->with('fail','Something went wrong, try again later.');
        }

        
    }

}
