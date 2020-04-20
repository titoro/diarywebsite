<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxReturnAnalystController extends Controller
{
    //
    public function ajax_sample(){
        // POSTされたJSON文字列を取り出し
        $json = file_get_contents("php://input");

        // JSON文字列をobjectに変換
        //   ⇒ 第2引数をtrueにしないとハマるので注意
        $contents = json_decode($json, true);

        // デバッグ用にダンプ
        // var_dump($contents);

        $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
        // var_dump(json(["apple" => "red", "peach" => "pink"]));
        // $arr = json_encode($arr);
        // return response()->json($arr);

        // return response()->json($arr);
        // return view('schedule.create');
        // return response()->json([
        //     'code' => '1',
        //     'name' => 'eigyou'
        // ]);
        return response()->json($contents);
    }
}
