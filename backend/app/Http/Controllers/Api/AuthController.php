<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Models\{User};
use App\Http\Requests\{AuthRequest, UserRequest};
use Illuminate\Http\JsonResponse;
use Exception;

class AuthController extends Controller
{
    public function authenticate(AuthRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        try {
            if(!Auth::attempt($credentials)){
                return response()->json([
                    'status' => false,
                    'message' => 'The given data was invalid',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

        $user = User::find(Auth::id());
        
        return $this->successResponse(compact('user'));
    }

    public function createUser(UserRequest $request): JsonResponse
    {
        try {
            if (User::where('email', $request->email)->first()) {
                throw new Exception('User with this email already exists');
            }
            
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = 2; // user role
            $user->save();

        } catch (Exception $e) {
            return response()->json([
                'response' => 'error',
                'message' => $e->getMessage()
            ], 403);
        }

        return $this->successResponse(compact('user'));
    }

    public function currentUser(): JsonResponse
    {
        if (Auth::check()) {
            return $this->successResponse(Auth::user());
        } else {
            return $this->errorResponse('Not authorized', 401);
        }
    }

    public function logout()
    {
        return auth()->guard('web')->logout();
    }
}