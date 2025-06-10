<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'user_id',
        'auction_id',
        'time',
        'price',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function auction(){
        return $this->belongsTo(Auction::class, 'auction_id');
    }
}
