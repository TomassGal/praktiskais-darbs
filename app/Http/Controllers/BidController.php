<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Auction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Auction $auction)
    {
        $validate = $request->validate([
            'price' => ['required','numeric', 'min:'.($auction->price +0.01), 'max:'.Auth::user()->balance],
        ]);
        $lastBid = Bid::orderBy('time', 'desc')->first();
        if($lastBid){
            $lastUser = User::find($lastBid->user_id);
            $lastUser->balance = $lastUser->balance + $lastBid->price;
            $lastUser->save();
        }
        Bid::create([
            'user_id' => Auth::id(),
            'auction_id' => $auction->id,
            'price' => $request->price,
        ]);
        $user = Auth::user();
        $user->balance = $user->balance - $request->price;
        $user->save();
        $auction->price = $request->price; 
        $auction->time = Carbon::parse($auction->time)->addHour();
        $auction->save();

        return redirect()->route('auction.show', $auction->id)->with('success', 'Bid added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
