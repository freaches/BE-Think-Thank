<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected function authenticated(Request $request)
 {
    $request->session()->flash('flash_notification.success', 'Congratulations, you have cracked the code!');
    return redirect()->intended($this->redirectTo());
 }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        

        $this->middleware('guest')->except('logout');
    }

    

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
 
        //  $password = Hash::make($request->password);
        $request->user()->fill([
            'password' => Hash::make($request->password)
        ])->save();
 
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
 
        //  var_dump("masuk");
         // public function login()
         // {
             // }
             
             // check if validation fails
             //   if ($validator->fails()) {
                 //     return response()->json($validator->errors(), 422);
                 // }
                 
                 $admin = Admin::where('username',  $request->input('username'))->first();
                 var_dump($validator->all()->toArray());
                 die();
                 if(!$admin || !Hash::check($validator['password'], $admin->password)) {                             return redirect('login')->with(['error' => 'Username or Password is Wrong!']);
                    return redirect('login')->with(['error' => 'Username or Password is Wrong!']);
                    }
                    return redirect('home');
                 
                         
                     
                         
                         // $admin->username = $request->username;
                         // 'token' => $this->whenNotNull($this->token)
                         
 
         // $admin->token = $this->whenNotNull($request->token);
         // $admin->token = Str::uuid()->toString();
 
    //      return new AvatarResource(true,"anda berhasil login", $admin 
    //      // ->cookie('token', Str::uuid()->toString(), 120)
    //  );
         // return response()->json((['result' => 'success for loggin']), 201)->cookie('token', Str::uuid()->toString(), 120);
     }


}
