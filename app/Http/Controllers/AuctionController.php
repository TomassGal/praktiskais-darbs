<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Auction;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auctions = Auction::whereNot('user_id', Auth::id())->doesntHave('sale')->withCount('bids')->orderBy('bids_count', 'desc')->get();
        return view('auctions.index', compact('auctions'));
    }
    public function sort(Request $request)
    {
        $auctions = Auction::whereNot('user_id', Auth::id())->doesntHave('sale');
        switch ($request->get('sort')) {
        case 'pop':
            $auctions = $auctions->withCount('bids')->orderBy('bids_count', 'desc')->get();
            break;
        case 'asc':
            $auctions = $auctions->orderBy('price', 'asc')->get();
            break;
        case 'desc':
            $auctions = $auctions->orderBy('price', 'desc')->get();
            break;
        }
        return view('auctions.index', compact('auctions'));
    }
    public function sortAsc()
    {
        $auctions = Auction::whereNot('user_id', Auth::id())->doesntHave('sale')->orderBy('price', 'asc')->get();
        return view('auctions.index', compact('auctions'));
    }
    public function sortDesc()
    {
        $auctions = Auction::whereNot('user_id', Auth::id())->doesntHave('sale')->orderBy('price', 'desc')->get();
        return view('auctions.index', compact('auctions'));
    }

    public function personalIndex(string $id)
    {
        $auctions = Auction::where('user_id', $id)->doesntHave('sale')->get();
        return view('auctions.personalIndex', compact('auctions', 'id'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Auction $auction)
    {
        if ($request->user()->cannot('create', $auction)) {
            abort(403, 'You are not authorized to create auctions.');
        }
        return view('auctions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Auction $auction)
    {
        if ($request->user()->cannot('create', $auction)) {
            abort(403, 'You are not authorized to create auctions.');
        }
        $validate = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => ['required', 'numeric'],
            'end' => ['required', 'after:now'],
            'image' => ['required','image','mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $imagePath = $request->file('image')->store('auctions', 'public');

        Auction::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'time' => $request->end,
            'image' => Storage::url($imagePath),
        ]);


        return redirect()->route('auction.index')->with('success', 'Auction created successfully!'); 
    }
    public function close(){
        $auctions = Auction::all();
        foreach($auctions as $auction){
            if(Carbon::parse($auction->time)->isPast() && !$auction->sale){
                if ($auction->bids()->count()){
                    $winnerBid = $auction->bids()->orderBy('price', 'desc')->first();
                    Sale::create([
                    'user_id' => $winnerBid->user_id,
                    'auction_id' => $auction->id,
                    ]);
                    $user = User::find($auction->user_id);
                    $user->balance = $user->balance + $auction->price;
                    $user->save();
                }
                else{
                    $this->destroy($auction->id);
                }

            }
        }
        
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auction = Auction::find($id);
        return view('auctions.show', compact('auction'));
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
        $auction = Auction::find($id);
        $lastBid = $auction->bids()->orderBy('price', 'desc')->first();
        if($lastBid){
            $lastUser = User::find($lastBid->user_id);
            $lastUser->balance = $lastUser->balance + $lastBid->price;
            $lastUser->save();
        }
        
        $path = ltrim(str_replace('/storage/', '', $auction->image), '/');  
        Storage::disk('public')->delete($path);
        Log::info('$auction->image');
        $auction->delete();
        return redirect()->route('auction.index')->with('success', 'Auction deleted successfully!'); 
    }
}
