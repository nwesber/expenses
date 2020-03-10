<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ], 200);
    }

    public function store(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('secret'),
            'role_id' => $request->role_id
        ]);

        return response()->json(
            [
                'status' => 'success',
            ], 200);
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $user->update($request->all());

        return response()->json([
            'data' => $user
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }

    public function destroy(Request $request){
        $user = User::find($request->id);
        $user->delete();

        return response()->json(
            [
                'status' => 'success'
            ], 200);
    }

}
