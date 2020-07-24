<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class WelcomeController extends Controller
{
    //// ここから追加
    public function index()
    {
        // ログイン中のユーザーID
        $user = Auth::user();   #ログインユーザー情報を取得します。

        // DB::enableQueryLog();

        // $array = [1,2,3];

        // dd($array);
        if($user){
            // 指定されたビューを返す
            return view('welcome')->with([
                "user_id" => $user->id,
                // "user" => $user
            ]);
        }else{
            return view('welcome');
        }
        
    }
    // ここまで追加
}
