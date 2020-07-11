<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;

class AuthController extends Controller
{
    
    /**
     * Create user
     * @param SignUpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(SignUpRequest $request)
    {
        $user = User::create($request->validated());
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }
    
    public function login(SignInRequest $request)
    {
        try {
        $user = User::where('email', $request->email)->first();
        
        if ( ! Hash::check($request->password, $user->password, [])) {
           throw new \Exception('Error in Login');
        }
        
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        
        return response()->json([
          'success' => true,
          'access_token' => $tokenResult,
          'token_type' => 'Bearer',
        ]);
          } catch (Exception $error) {
                return response()->json([
                  'success' => false,
                  'message' => 'Error in Login',
                  'error' => $error,
                ]);
          }
    }
}
