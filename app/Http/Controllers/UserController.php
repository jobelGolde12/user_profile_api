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
    /**
     * Register a new user and store their information.
     */
    public function store(Request $request)
    {
        try {
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

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Authenticate user and return token.
     */
    public function login(Request $request)
    {
        try {
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

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get the authenticated user's profile.
     */
    public function show(Request $request)
    {
        try {
            $user = User::first();
            return response()->json($user);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request)
    {
        try {
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

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete the authenticated user's account.
     */
    public function destroy(Request $request)
    {
        try {
            $user = User::first();
            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Upload or update the authenticated user's profile picture.
     */
    public function uploadProfilePicture(Request $request)
    {
        try {
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

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Change the authenticated user's password.
     */
    public function changePassword(Request $request)
    {
        try {
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

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(Request $request)
    {
        try {
            return response()->json(['message' => 'Logout successful']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get a list of all users. (Admin function)
     */
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * View a specific user by ID. (Admin function)
     */
    public function view($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json($user);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a specific user by ID. (Admin function)
     */
    public function delete($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
