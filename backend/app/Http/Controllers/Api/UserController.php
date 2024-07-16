<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\{Auth, Mail};
use App\Models\{User};
use Illuminate\Http\{Request, JsonResponse};
use Exception;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $query = User::query();

        $users = $query
            ->paginate(request('perPage') ?? 10);

        return $this->successResponse($users);
    }

    public function show(User $user): JsonResponse
    {
        return $this->successResponse($user);
    }

    public function store(UserRequest $request): JsonResponse
    {
        try {
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->district_id = $request->district_id;
            $user->school_id = $request->school_id;
            $user->role_id = $request->role_id;
            $user->last_login = Carbon::now();
            $user->save();

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

        return $this->successResponse($user);
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {
        try {
            return $this->successResponse($user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]));
        } catch(Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}