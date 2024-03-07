<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

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
        // upload image
        $image = $request->file('image');
        $image->storeAs('public/avatars', $image->hashName());

        //create Avatar
        Avatar::create([
            'image'     => $image->hashName(),
            'diamond'     => $request->diamond,
            'isLocked'   => $request->isLocked,
        ]);


        // $avatar->image = $request->image;
        // $avatar->diamond = $request->diamond;
        // $avatar->save();
        return response() ->json(["resuld"=>"ok"], 201);
    }
}
