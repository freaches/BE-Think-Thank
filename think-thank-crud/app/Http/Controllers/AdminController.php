<?php

namespace App\Http\Controllers;

use App\Http\Resources\AvatarResource;
use App\Models\Admin;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Cookie;

// use App\Models\Admin::fails()
// use Illuminate\Validation\Validator;

class AdminController extends Controller
{

    public function index()
   {
        $admin = Admin::all();
        // return view('welcome', compact('admins'));
        return new AvatarResource(true,"semua data berhasil di dapatkan", $admin);
   }
    public function store(Request $request){
        // $this ->validate
        $validator = Validator::make($request->all(), [
            'username'     => 'required|string',
            'password'     => 'required|string',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $password = Hash::make($request->password);

        //create Avatar
        $admin = Admin::create([
            'username'     => $request->username,
            'password'   => $password,
        ]);

        return new AvatarResource(true, 'data berhasil ditambahkan', $admin);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'username'     => 'required|string',
            'password'     => 'required|string',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin = Admin::where('_id', $id)->first();
        if(!$admin){
            throw new HttpResponseException(response([
                "errors" => "anda blom berhak menjadi admin"
            ], 400));
        };
        // if($request->hasFile("image")){
        //     $upload = $request->file('image')->storeOnCloudinary('think-thank');
        //     $avatar->image= $upload->getSecurePath();

        // }
        // $image = $request->file('image');
        // $image->storeAs('public/avatars', $image->hashName());
        $password = Hash::make($request->password);
        
        $admin->username = $request->username;
        $admin->password = $password;
        $admin->update();



        // $avatar = Avatar::findorFail($id)   
        // ->update([
        //     'image'     => $request->image ? $request->image->hashName():Avatar::where('id','=',$id)->first()->image,
        //     // 'image'         => $request->image ? $request->image->hashName():Avatar::where('id','=',$id)->first()->image,
        //     // 'image'     => $request->image ? $request->image->hashName()     : null,
        //     'diamond'   => $request->diamond,
        //     'isLocked'  => $request->isLocked,
        // ]);
        return new AvatarResource(true,"data berhasil di update", $admin);
    }

    public function destroy($id)
    {
        $admin = Admin::where('_id', $id)->first();

        $admin->delete();
        // return response()->json([
        //     'message' => 'delete quiz success'
        // ])->setStatusCode(200);
        return new AvatarResource(true,"data berhasil di delete", $admin);
    }


//     public function register(AdminRequest $request) 
//     {
//         $data = $request->validated();


//         if(Admin::where('username', $data['username']) -> count() == 1){
//             throw new HttpResponseException(response([
//                 "errors" => [
//                     "username" => [
//                         "username already registered"
//                     ]
//                 ]
//             ], 400));
//         }

//         $admin = new Admin($data);
//         $admin->password = Hash::make($data['password']);
//         $admin->save();

//         return response()->json((['result' => 'success for register']), 201);
//     }

    public function login(Request $request)
    {
        $validator = Admin::make($request->all(), [
            
            'username'     => 'required|string',
            'password'     => 'required|string',
            // 'token' => $this->whenNotNull($this->token)
        ]);

        // public function login()
        // {
            // }
            
            // check if validation fails
            //   if ($validator->fails()) {
                //     return response()->json($validator->errors(), 422);
                // }
                
                $admin = Admin::where('username',  $request->input('username'))->first();
                if(!$admin || !Hash::check($validator['password'], $admin->password)) {
                    throw new HttpResponseException(response([
                        "errors" => [
                            "message" => [
                                "username or password wrong!"
                                ]
                                ]
                            ], 401));
                        }
                        
                        // if (Admin::check()) {
                        //     return redirect('home');
                        // }else{
                        //     return view('login');
                        // }
                        
                        // $admin->username = $request->username;
                        // 'token' => $this->whenNotNull($this->token)
                        

        // $admin->token = $this->whenNotNull($request->token);
        // $admin->token = Str::uuid()->toString();
        $admin->save();

        return new AvatarResource(true,"anda berhasil login", $admin 
        // ->cookie('token', Str::uuid()->toString(), 120)
    );
        // return response()->json((['result' => 'success for loggin']), 201)->cookie('token', Str::uuid()->toString(), 120);
    }

    //user
    // $user= User::find(PersonalAccessToken::findToken(explode(' ',$request->header('Authorization'))[1])->tokenable_id);

    //delete token
        // $user->tokens()->delete();

    //reponse
        // return response([
        //     'message'=> 'logout success',
        // ], 200);
    }



