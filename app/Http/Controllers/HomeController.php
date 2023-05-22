<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NFT;
use App\Models\Collections;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $open_collections = NFT::whereNull('owner')->groupBy('collection_id')->select('collection_id')->get();
        foreach ($open_collections as $collection) {
            $collection->collection_name = Collections::where('id',$collection->collection_id)->pluck('name')->firstOrFail();
        }


        return view('homepage', compact('open_collections'));
    }
}
