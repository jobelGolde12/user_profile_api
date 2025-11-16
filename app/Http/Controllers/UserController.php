<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users',
            'contact_number' => 'nullable|string|max:50',
            'address'    => 'nullable|string|max:255',
            'birthdate'  => 'nullable|date',
            'gender'     => 'nullable|in:Male,Female',
            'password'   => 'required|string|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = Str::random(60);

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ]);
    }

    public function show(Request $request)
    {
        $user = User::first();
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = User::first();

        $data = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'email'      => 'nullable|email|unique:users,email,' . $user->id,
            'contact_number' => 'nullable|string|max:50',
            'address'    => 'nullable|string|max:255',
            'birthdate'  => 'nullable|date',
            'gender'     => 'nullable|in:Male,Female',
        ]);

        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    public function destroy(Request $request)
    {
        $user = User::first();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function uploadProfilePicture(Request $request)
    {
        $user = User::first();

        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }

        $path = $request->file('file')->store('profile_pictures');

        $user->update(['profile_picture' => $path]);

        return response()->json([
            'message' => 'Profile picture updated successfully',
            'profile_picture' => $path
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = User::first();

        $data = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        if (!Hash::check($data['old_password'], $user->password)) {
            return response()->json(['message' => 'Old password does not match'], 400);
        }

        $user->update(['password' => Hash::make($data['new_password'])]);

        return response()->json(['message' => 'Password changed successfully']);
    }

    public function logout(Request $request)
    {
        return response()->json(['message' => 'Logout successful']);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function view($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
