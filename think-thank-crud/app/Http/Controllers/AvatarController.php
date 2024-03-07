<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;

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
        $avatar->image= $request->image;
        $avatar->diamond  = $request->diamond;

        $avatar->save();
        return response()->json(["result" =>"ok"], 201);
    }
}
