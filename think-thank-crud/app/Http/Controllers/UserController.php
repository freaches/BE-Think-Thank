<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Resources\AvatarResource;

class UserController extends Controller
{
    public function register(Request $request) 
    {
        
    //     $data = $request->validated();
    $validator = User::make($request->all(), [
        'email' =>  ['required', 'string', 'max:255', 'unique:users'],
        'username' =>  ['required','string','min:3','max:255','unique:users'],
        'avatar' => ['image', 'string'],
        'diamond' => ['numeric']?? 0,
        // 'score' => ['numeric'] ?? 0,

    ]);

        if(User::where('email', $validator['email']) -> count() == 1){
            return new AvatarResource(true, "anda berhasil Login!", $validator['email']);
            // return response([
            //     'message' => 'Login Success!'
            // ], 200);
            // ->cookie('token', Str::uuid()->toString());
        }
        

        $user = new User();
        $user->email = $validator['email'];
        $user->username = $validator['username'] ?? null;
        $user->avatar = $validator['avatar'] ?? null;
        $user->diamond = $validator['diamond'] ?? 0;
        // $user->score = $data['score'] ?? 0;
        $user->save();

        // return response()->json([
        //     'message' => 'Register Success!'
        // ], 201)->cookie('token', Str::uuid()->toString());
        return new AvatarResource(true,"Register Success!", $user 
        // ->cookie('token', Str::uuid()->toString(), 120)
    );
    }

    // public function logout()
    // {
    //     return response()->json([
    //         'message' => 'Logout Success!'
    //     ], 200)->withCookie(Cookie::forget('token'));
    // }

    // public function updateFirst(UserUpdateFirst $request): UserResource
    // {
    //     $data = $request->validated();

    //     if(User::where('username', $data['username'])->count() == 1){
    //         throw new HttpResponseException(response([
    //             "errors" => 'username already exist'
    //         ], 400));
    //     };
    //     $user = User::where('email', $data['email'])->first();
    //     $user->username = $data['username'];
    //     $user->avatar = $data['avatar'];
    //     $user->update();
    //     return new UserResource($user);
    // }

    // public function editAvatar(UserAvatarRequest $request, $id)
    // {
    //     $data = $request->validated();

    //     $user = User::where('_id', $id)->first();
    //     $user->avatar = $data['avatar'];
    //     $user->update();
    //     return new UserResource($user);
    // }

    // public function winner($id)
    // {
    //     $user = User::where('_id', $id)->first();
    //     $user->diamond = $user->diamond + 1;
    //     $user->update();
    //     return new UserResource($user);
    // }
}
