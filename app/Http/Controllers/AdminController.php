<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NFT;
use App\Models\PurchaceHistory;
use App\Models\NftListings;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin_dash');
    }

    public function index_users()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->nft_amount = NFT::where('owner', $user->id)->count();
            $user->buy_amount = PurchaceHistory::where('user', $user->id)->count();
        }

        return view('admin_manage_users', compact('users'));
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

    public function show_user($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        return view('admin_show_user', compact('user'));
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

    public function user_update(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $request->validate([
            'name'=>'min:5|max:15',
            'email'=>'email|unique:users,email,'.$id,
            'balnce'=>'max:9999999999.99|min:0|numeric',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->balance = $request->balance;

        $user->save();

        if ($user) {
            return back()->with('success', 'User details updated!');
        }
        else {
            return back()->with('fail','Something went wrong, try again later');
        }

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

    public function user_destroy($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $nfts = NFT::where('owner', $id)->get();

        foreach ($nfts as $nft) {
            $listing = NftListings::where('nft', $nft->id)->first();

            if ($listing) {
                $listing->delete();
            }

            $nft->owner = NULL;
            $nft->save();
        }

        $history = PurchaceHistory::where('user', $id)->get();
        foreach ($history as $record) {
            $record->delete();
        }
        $user->is_active = 0;
        $user->save();
        $user->delete();

        return redirect('admin/user/manage/users')->with('success', 'User deleted.');

    }
}
