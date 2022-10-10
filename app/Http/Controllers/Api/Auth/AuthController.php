<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'credentials' => ['The provided credentials are incorrect.'],
            ]);
        }
//        if($request->has('logout_others_devices')){        }
        $user->tokens()->delete();
        $ability = [''];
        if($user->is_admin){
            $ability = ['create-users'];
        }
        $token = $user->createToken($request->device_name, $ability)->plainTextToken;
        return response()->json([
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['success' => true]);
    }

    public function me()
    {
        $user = auth()->user();
        return new UserResource($user);
    }
}
