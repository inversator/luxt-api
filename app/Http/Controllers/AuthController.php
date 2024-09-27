<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', [
            'except' => ['login', 'register']
        ]);
    }

    /**
     * Registers a new user with the provided credentials.
     *
     * @param RegisterRequest $request The request object containing the user's credentials.
     * @return JsonResponse The JSON response containing the registration status.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => ResponseStatus::Success->value,
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }

    /**
     * Logs in a user with the provided credentials.
     *
     * @param AuthRequest $request The request object containing the user's credentials.
     * @return JsonResponse The JSON response containing the login status and token.
     */
    public function login(AuthRequest $request): JsonResponse
    {
        if ($request->username) {
            $request->merge(['name' => $request->username]);
        }

        $credentials = $request->only('name', 'email', 'password');

        if (auth()->attempt($credentials)) {
            $user = Auth::user();

            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            $cookie = cookie('access_token', $token, 60 * 24 * 7, '/', 'localhost', false, true);

            return response()->json([
                'status' => 1,
                'token' => $token,
                'user' => $user
            ])->withCookie($cookie);
        }

        return response()->json([
            'error' => 'Unauthorized',
            'status' => ResponseStatus::Error->value
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Logs out the currently authenticated user.
     *
     * @return JsonResponse The JSON response containing the logout status.
     */
    public function logout(): JsonResponse
    {
        $user = Auth::user();

        // Delete tokens
        $user->tokens()->delete();
        $cookie = cookie()->forget('access_token');

        // Logout from guard is not needed if we use sanctum tokens
        //// Auth::logout();

        return response()->json([
            'status' => ResponseStatus::Success->value
        ])->withCookie($cookie);
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'status' => ResponseStatus::Success->value,
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }
}
