<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle user login and return an API token.
     */
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'userCode'    => 'required|string|min:4|exists:users,userCode',
            'password' => 'required|string|min:8',
        ]);

        // Retrieve the user by userCode
        $user = User::where('userCode', $request->userCode)->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'userCode' => ['The provided credentials are incorrect.'],
                'success' => false,
            ], Response::HTTP_UNAUTHORIZED);
        }

        $request->session()->regenerate();
        // Create a new token for the user
        $token = $user->createToken($user->name)->plainTextToken;

        // Return the token in a secure JSON response
        return response()->json([
            'user' => $user,
            'token' => $token,
            'success'=> true,
        ], Response::HTTP_CREATED);
    }

    /**
     * Handle user logout by revoking the current token.
     */
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
        ], Response::HTTP_OK);
    }
}
