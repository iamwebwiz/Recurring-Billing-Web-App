<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          description="The user's email address",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="password",
     *          in="query",
     *          required=true,
     *          description="The user's password",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Successful Login")
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh authentication token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * @OA\Get(
     *     path="/api/auth/profile",
     *     @OA\Parameter(
     *          name="Authorization",
     *          in="path",
     *          required=true,
     *          description="The authenticated user's token",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="Successful"
     *      )
     * )
     */
    public function profile(Request $request)
    {
        return Response::json(Auth::user());
    }
}
