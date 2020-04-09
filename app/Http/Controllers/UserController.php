<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function index(){
        // $data = [
        //     'msg' => 'これはBladeを用いたサンプルです'
        // ];
        // return view('user/index',$data);
        // $items = DB::select('select * from people');
        $items = User::all();
        return view('user.index',['items' => $items]);
    }

    public function post(Request $request){
        $msg = $request->msg;
        $data = [
            'msg' => 'こんにちは'. $msg . 'さん'
        ];
        return view('user.index', $data);
    }
}
