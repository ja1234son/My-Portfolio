<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $users)
    {
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      $request->validate([
            'name' => 'required|string|min:5|max:8',
            'email' => 'required|email|unique:users,email,email',
            'password' =>'required'
      ]);
         $users =  User::create(
        [
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
        ]
      );

      return $users;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
      return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update([
        'name' => $request->name,
     ]);
     return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
      $user->delete();
      return print_r(4);
    }
}
