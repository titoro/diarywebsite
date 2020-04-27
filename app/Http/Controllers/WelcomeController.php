<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //// ここから追加
    public function index()
    {
        // 指定されたビューを返す
        return view('welcome');
    }
    // ここまで追加
}
