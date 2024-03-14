<?php

namespace App\Http\Controllers;

use App\Http\Resources\AvatarResource;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionAnswerController extends Controller
{
    public function store(Request $request){
         // $this ->validate
         $validator = Validator::make($request->all(), [
            'question'     => 'required|string',
            'answerTrue'     => 'required|string',
            'answerFalse'     => 'required|array|min:3',
            'score'     => 'required|int',
            'hint'     => 'required|string',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Avatar
        $admin = QuestionAnswer::create([
            'question'     => $request->question,
            'answerTrue'     => $request->answerTrue,
            'answerFalse'     => $request->answerFalse,
            'score'     => $request->score,
            'hint'     => $request->hint,
        ]);

        return new AvatarResource(true, 'data berhasil ditambahkan', $admin);
    }
}
