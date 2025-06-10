<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'user_id',
        'price',
        'time',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sale(){
        return $this->hasOne(Sale::class, 'auction_id')
    }
    public function bids(){
        return $this->hasMany(Bid::class, 'auction_id')
    }
}
