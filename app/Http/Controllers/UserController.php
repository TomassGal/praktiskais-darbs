<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
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
        $validate = $request->validate([
            'price' => ['required', 'numeric'],
        ]);
        $user = User::find($id);
        $user->increment('balance', $request->price);
        return view('users.show', compact('user'));
    }
    public function block(Request $request, string $id)
    {
        $user = User::find($id);
        $user->blocked = true;
        $user->update();
        return view('users.show', compact('user'));
    }
    public function unBlock(Request $request, string $id)
    {
        $user = User::find($id);
        $user->blocked = false;
        $user->update();
        return view('users.show', compact('user'));
    }
    public function makeAdmin(Request $request, string $id)
    {
        $user = User::find($id);
        $user->role = "admin";
        $user->update();
        return view('users.show', compact('user'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
