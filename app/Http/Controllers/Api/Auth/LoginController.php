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

class LoginController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    // public function login(Request $request)
    // {
    //     dd($request);
    //     return $this->loginHandle($request->email, $request->password);
    // }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
    
        return redirect('/');
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'email' => 'required|email|unique:users',
        ]);
        
        if($validation->fails()){
            $response['status'] = $validation->errors();
            $response = [
                'status' => 403, 
                'success'=>false
            ];
            return response()->json($response['status']);
           
        }  else {
            try {
                $filename = helper::upload($request->file('avatar'), config('settings.defaultPath'));
                $users = [
                    'full_name' => $request->full_name,
                    'avatar' => $filename,
                    'email' => $request->email,
                    'password' => $request->password,
                    'address' => $request->address,
                    'gender' => $request->gender,
                    'level' => config('settings.level.user'),
                    'status' => config('settings.status.inprogress'),
                ];

                $users = $this->userRepository->create($users);

                return response()->json($users);
            } catch (Exception $e) {
                $response['error'] = true;

                return response()->json($response);
            }
        }
    }

    // public function loginHandle($email, $password)
    // {
    //     // $user = Auth::attempt(['email' => $email, 'password' => $password]);
    //     // if ($user) {

    //     //     // return response()->json($user);
    //     // }
    // }
    
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'email' => 'required|email|unique:users',
        ]);
        
        if($validation->fails()){
            try {
                $credentials = [
                    'email' => $request['email'],
                    'password' => $request['password'],
                ];
        
                if(Auth::attempt($credentials)) {
                    $user = User::where('email', $request->email)->get();
                    
                    return response()->json($user);   
                }
            } catch (Exception $e) {
                $response['error'] = true;

                return response()->json($response);
            }
           
        } else {
            $response = 403;

            return response()->json($response);
        }
      
    }
}
