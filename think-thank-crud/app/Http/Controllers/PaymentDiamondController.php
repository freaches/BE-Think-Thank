<?php

namespace App\Http\Controllers;

use App\Http\Resources\AvatarResource;
use App\Models\PaymentDiamond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentDiamondController extends Controller
{
    public function store(Request $request){
          // $this ->validate
          $validator = Validator::make($request->all(), [
            'idStockDiamond'     => 'required|string',
            'idUser'     => 'required|string',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Avatar
        $payment = PaymentDiamond::create([
            'idAvatar'     => $request->idStockDiamond,
            'idUser'   => $request->idUser,
        ]);

        return new AvatarResource(true, 'data berhasil ditambahkan', $payment);
    }
}
