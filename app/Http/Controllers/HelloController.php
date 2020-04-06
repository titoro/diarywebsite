<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{
    //
    public function index(){
        // $data = [
        //     'msg' => 'これはBladeを用いたサンプルです'
        // ];
        // return view('hello/index',$data);
        // $items = DB::select('select * from people');
        $items = User::all();
        return view('hello.index',['items' => $items]);
    }

    public function post(Request $request){
        $msg = $request->msg;
        $data = [
            'msg' => 'こんにちは'. $msg . 'さん'
        ];
        return view('hello.index', $data);
    }
}
