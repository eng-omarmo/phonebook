<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    use ApiResponse;
    public function login(LoginRequest $request): JsonResponse
    {

        try {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return $this->errorResponse('Invalid credentials', 401);
            }
            $user =  User::find(Auth::user()->id);
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->successResponse([
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->serverErrorResponse($th->getMessage());
        }
    }

    public function logout()
    {
        $user =  User::find(Auth::user()->id);
        $user->tokens()->delete();
        return $this->successResponse(null, 'Logout successfully');
    }
}
