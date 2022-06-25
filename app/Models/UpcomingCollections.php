<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collections;

class UpcomingCollections extends Model
{
    use HasFactory;
    protected $table = 'upcoming_collections';

    public function collections() {
        return $this->belongsTo(Collections::class);
    }
}
