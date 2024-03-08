<?php

namespace App\Http\Controllers;

use App\Models\StockDiamond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockDiamondController extends Controller
{
    public function store(Request $request){

        // $validator = Validator::make($request->all(), [
        //     "diamond"=> "required|int",
        //     "priceMoney"=> "required|int",
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(),422);
        // }
        //create Diamond
        StockDiamond::create([
            'diamond'     => $request->diamond,
            'priceMoney'   => $request->priceMoney,
        ]);

        return response() ->json(["resuld"=>"ok"], 201);
    }
}
