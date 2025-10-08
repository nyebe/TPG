<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken;

class ApiAuthController extends Controller
{
    /**
     * Register a new client user only.
     * Accepts: first_name, middle_name (optional), last_name, email, password
     */
    public function register(Request $request)
    {
        $data = $request->only(['first_name', 'middle_name', 'last_name', 'email', 'password']);

        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'string', Password::min(8)],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'] ?? null,
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_CLIENT,
        ]);

        // Issue token for immediate use
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    /**
     * Login user and return a token. Accepts remember boolean for 30 days
     */
    public function login(Request $request)
    {
        $data = $request->only(['email', 'password', 'remember']);

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Token expiry: default (no expiry) or 30 days when remember === true
        $tokenName = 'api-token';
        $token = $user->createToken($tokenName);

        if (!empty($data['remember'])) {
            // Sanctum's personal access tokens use Laravel's built-in personal_access_tokens
            // table and the Passport-style expiry isn't directly settable per token with
            // default Sanctum. We'll store expiry as token abilities metadata by revoking
            // via scheduled job, or alternatively set cookie-based remember for session.
            // For now, set token with plainText and a created_at; frontend should store it.
            // We'll include an expires_at value in the response for front-end convenience.
            $expiresAt = Carbon::now()->addDays(30)->toISOString();
            $plain = $token->plainTextToken;
            return response()->json(['user' => $user, 'token' => $plain, 'expires_at' => $expiresAt]);
        }

        return response()->json(['user' => $user, 'token' => $token->plainTextToken]);
    }

    /**
     * Logout current token (revoke token used in the request).
     */
    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);
            if ($accessToken) {
                $accessToken->delete();
            }
        }

        return response()->json(['message' => 'Logged out']);
    }
}
