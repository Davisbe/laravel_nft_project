<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NFT;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class CommentController extends Controller
{
    public function store(Request $request, $nft_id) {

        /*
        protected $fillable = [
            'user',
            'nft',
            'body'
        ];
        */

        $request->validate([
            'comment'=>'required|string|min:4|max:250',
        ]);

        $nft = NFT::where('id', $nft_id)->firstOrFail();

        Comment::create([
            'user_id' => Auth::user()->id,
            'nft_id' => $nft->id,
            'body' => $request->comment
        ]);

        return Redirect::to(URL::previous() . "#comments");
    }
}
