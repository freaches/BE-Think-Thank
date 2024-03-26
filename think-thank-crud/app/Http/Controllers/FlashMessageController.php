<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlashMessageController extends Controller
{
    public function index()
{
   return view('message');
}

public function message()
{
   return redirect('/message')->with(['success' => 'Pesan Berhasil']);
}
}
