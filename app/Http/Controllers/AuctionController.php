<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Auction;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auctions = Auction::all();
        return view('auctions.index', compact('auctions'));
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


        return redirect()->route('auction.index')->with('success', 'Auction created
            successfully!'); 
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
