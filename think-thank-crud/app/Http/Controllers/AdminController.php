<?php

namespace App\Http\Controllers;

use App\Http\Resources\AvatarResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function store(Request $request){
        // $this ->validate
        $validator = Validator::make($request->all(), [
            'account'     => 'required|string',
            'password'     => 'required|string',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $password = Hash::make($request->password);

        //create Avatar
        $admin = Admin::create([
            'account'     => $request->account,
            'password'   => $password,
        ]);

        return new AvatarResource(true, 'data berhasil ditambahkan', $admin);
    }
}
