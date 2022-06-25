<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NFT;
use App\Models\UpcomingCollections;

class Collections extends Model
{
    use HasFactory;

    protected $table = 'collections';

    function nft() {
        return $this->hasMany(NFT::class, 'collection_id');
    }

    function upcoming_collections() {
        return $this->hasOne(UpcomingCollections::class, 'collection_id');
    }
}
