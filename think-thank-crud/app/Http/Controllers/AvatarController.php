<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

//import Resource "PostResource"
use App\Http\Resources\AvatarResource;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class AvatarController extends Controller
{
    public function show($slug) 
    {
        return view('avatar', [
            'avatar'=> Avatar::where('slug','=', $slug)->first()
            ]);
    }

    // public function index(): View
    // {
    //     //get posts
    //     $posts = Post::latest()->paginate(5);

    //     //render view with posts
    //     return view('avatars.index', compact('avatars'));
    // }

    // public function create(): View
    // {
    //     return view('avatars.create');
    // }


    public function store(Request $request){

        // $avatar = new Avatar;

        // $this ->validate
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'diamond'     => 'required',
            'isLocked'   => 'required|boolean',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/avatars', $image->hashName());

        //create Avatar
        $avatar = Avatar::create([
            'image'     => $image->hashName(),
            'diamond'     => $request->diamond,
            'isLocked'   => $request->isLocked,
        ]);


        // $avatar->image = $request->image;
        // $avatar->diamond = $request->diamond;
        // $avatar->save();
        // return response() ->json(["resuld"=>"ok"], 201);
        return new AvatarResource(true, 'data berhasil ditambahkan', $avatar);
    }

    public function update(Request $request, $id){
        // $validator = Validator::make($request->all(), [
        //     'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'diamond'     => 'required',
        //     'isLocked'   => 'required|boolean',
        // ]);

        // // check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        $avatar = Avatar::findorFail($id)   
        ->update([
            'image'     => $request->image ? $request->image->hashName():Avatar::where('id','=',$id)->first()->image,
            // 'image'         => $request->image ? $request->image->hashName():Avatar::where('id','=',$id)->first()->image,
            // 'image'     => $request->image ? $request->image->hashName()     : null,
            'diamond'   => $request->diamond,
            'isLocked'  => $request->isLocked,
        ]);
        return new AvatarResource(true,"data berhasil di update", $avatar);
    }
}
