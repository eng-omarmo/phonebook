<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Controllers\Traits\ApiResponse;
use App\Http\Requests\UserUpdateRequest;

class AuthenticationController extends Controller
{
    use ApiResponse;
    public function index()
    {
        try {
            $user = User::find(request()->id);
            return $this->successResponse(
                $user,
                'User retrieved successfully',
            );
        } catch (\Throwable $th) {
            return $this->serverErrorResponse(
                $th->getMessage()
            );
        }
    }

    public function store(UserStoreRequest $request)
    {
        $user =  User::create($request->validated());
        return $this->successResponse(
            $user,
            'User created successfully',
        );
    }

    public function update(UserUpdateRequest $request)
    {
        try {
            $user = User::find(request()->id);
            $user->update($request->validated());
            return $this->successResponse(
                $user,
                'User updated successfully',
            );
        } catch (\Throwable $th) {
            //throw $th;
        }

    }
}
