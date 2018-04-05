<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\helper;
use Illuminate\Support\Facades\Input;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    private $jwtAuth;

    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        // $user = User::where('email', $request->email)->first();
        $user = JWTAuth::toUser($token);

        return response()->json([
            'response' => 'success',
            'user' => $user,
            'token' => $token,
        ]);   
    }

    public function getAuthUser(Request $request)
    {
        try {
            $user = JWTAuth::toUser($request->token);  

            return response()->json(['result' => $user]);
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'missing_token',
            ]);
        }
    }
    
    // public function logout()
    // 
    //     $token = $this->jwtAuth->getToken();
    //     $this->jwtAuth->invalidate($token);
    //     return response()->json(['logout']);
    // }
}
