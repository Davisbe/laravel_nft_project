<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collections;
use App\Models\User;
use App\Models\NftListings;


class NFT extends Model
{
    use HasFactory;

    protected $table = 'nft';
    protected $fillable = [
        'name',
        'collection_id',
        'file_path',
        'owner'
    ];

    public function collections() {
        return $this->belongsTo(Collections::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function nft_listings() {
        return $this->hasOne(NftListings::class, 'nft');
    }

    public function purchace_history() {
        return $this->hasMany(NftListings::class, 'nft');
    }
}
