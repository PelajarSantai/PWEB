<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // READ (Get all users)
    public function index()
    {
        return User::all();
    }

    // CREATE (Add new user)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $user = User::create($validated);

        return $user;
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $user->update($validated);

        return $user;
    }



    // DELETE (Remove user)
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return ['message' => 'User deleted'];
    }


}
