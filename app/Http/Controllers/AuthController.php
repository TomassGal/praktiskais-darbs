<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function showRegister(){
        return view('auth.register');
    }

    public function showLogin(){
        return view('auth.login');
    }
    public function register(Request $request){
        $validate = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => 'required',
            'confirm' => ['required', 'same:password'],
            'name' => ['required', 'unique:users,name'],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            ]);
        Auth::login($user);
        return redirect()->route('auction.index')->with('success', 'Account created and logged in');
    }

    public function login(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->route('auction.index')->with('success', 'Login sucesfull'); 
        }
        else{
            return redirect()->route('auth.login')->with('error', 'Username or password incorrect'); 
        }

    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('auth.login');
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
