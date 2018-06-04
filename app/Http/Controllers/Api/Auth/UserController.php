<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Helpers\helper;
use Validator;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAll();

        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = $this->userRepository->show($id);

        return response()->json($users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[ 
            'email' => 'required|email',
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
                $users = User::find($id);
                $users->full_name =  $request->full_name;
                $users->email = $request->email;
                $users->address = $request->address;
                $users->gender = $request->gender;

                $users = $users->save();

                return response()->json($users);
            } catch (Exception $e) {
                $response['error'] = true;

                return response()->json($response);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeAvatar(Request $request, $id)
    {
        $user = User::findOrFail($id);
        try {
            $filename = helper::upload($request->file('avatar'), config('settings.defaultPath'));
            $user->avatar = $filename;
            $user->save();
        } catch (Exception $e) {
            echo $e->get_message();
        }
        return response()->json($user);
    }

    public function search(Request $request) {
        $keywork = Input::get('keywork');
        $users = $this->userRepository->search($keywork);

        return response()->json($users);
    }
}
