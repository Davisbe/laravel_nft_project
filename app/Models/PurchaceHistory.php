<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\NFT;

class PurchaceHistory extends Model
{
    use HasFactory;
    protected $table = 'purchace_history';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function nft() {
        return $this->belongsTo(NFT::class);
    }
}
