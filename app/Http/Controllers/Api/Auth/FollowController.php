<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $follow = new Follow();
        $follow->fill($request->all());
        $follow->save();

        return response()->json($follow);
    }

    public function unFollow(Request $request)
    {

        $unFollow = new Follow();
        $unFollow = Follow::where('follower_id', $request->follower_id)->where('following_id', $request->following_id)->delete();

        return response()->json($unFollow);

    }

    public function checkFollow(Request $request)
    {

        $check = new Follow();
        $check = Follow::where('follower_id', $request->follower_id)->where('following_id', $request->following_id)->first();

        return response()->json($check);

    }
}