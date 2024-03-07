<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function show($slug) 
    {
        return view('avatar', [
            'avatar'=> Avatar::where('slug','=', $slug)->first()
            ]);
    }

    public function store(Request $request){
        $avatar = new Avatar;

        $avatar->image = $request->image;
        $avatar->diamond = $request->diamond;
        $avatar->save();
        return response() ->json(["resuld"=>"ok"], 201);
    }
}
