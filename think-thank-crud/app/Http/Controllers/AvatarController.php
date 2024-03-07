<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;

class AvatarController extends Controller
{

    public function store(Request $request){
        $avatar = new Avatar;
        $avatar->image= $request->image;
        $avatar->diamond  = $request->diamond;

        $avatar->save();
        return response()->json(["result" =>"ok"], 201);
    }
}
