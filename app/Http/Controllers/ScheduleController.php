<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Content;
use App\Analyst;
use DB;

class ScheduleController extends Controller
{
    public function index (Request $request) 
    {
        $hello = 'Hello,World!';
        $hello_array = ['Hello', 'こんにちは', 'ニーハオ'];

        $result = array();

        $date = $request->input('date');
        $user = $request->input('user');
        // return view('home')->with('val', $value);

        if(isset($_POST)){
            // $result = $_POST['result'];
            foreach($_POST as $key => $value) {
                if($key === 'status'){
                    $result[$key] = $value;
                }
            }
        }

        // if($all = Request::all()){
        //     $result = $all = Request::all();
        // }

        // $result = array("2" => "2","3" => "3");

        // 1日のスケジュールを全て取得
        // $schedule = new Schedule();
        // $result = DaySchedule::with('contents')->find(1)->toArray();
        // $schedules = Schedule::with('contents')->where('date','2020-04-08')->orderBy('from_time')->get();
        $date = $date ? $date : date("yy-m-d"); 
        $schedules = Schedule::where('date',$date)
                                ->where('user_id',1)
                                ->where('type',1)
                                ->where(function ($query) {
                                    $query->where('del_flg',0)->orWhereNull('del_flg');
                                })
                                // ->orWhereNull('del_flg')
                                ->orderBy('from_time')->get();

        // dd($date);

        // 確認したいSQLの前にこれを仕込んで
        // DB::enableQueryLog();

        $zisekis = Schedule::where('date',$date)->where('user_id',1)->where('type',2)
                        ->where(function ($query) {
                            $query->where('del_flg',0)->orWhereNull('del_flg');
                        })->orderBy('from_time')->get();

        // dd(DB::getQueryLog());

        // return view('dayschedule.index', compact('day_schedules', 'day_schedules'));
        // if($date && $user){
        //     // return view('schedule.index',compact('date', 'date'));
        //     return view('schedule.index')->with([
        //         "date" => $date,
        //         "user" => $user,
        //      ]);
        // }
        // var_dump($result);

        if($schedules || $zisekis){
            // var_dump($schedules);
            // return view('schedule.index',compact('result', 'schedules'));
            return view('schedule.index')->with([
                        "date" => $date,
                        "result" => $result,
                        "schedules" => $schedules,
                        "zisekis" => $zisekis,
                        "user" => $user
            ]);
        }else{
            return view('schedule.index');
        }
    }

    public function create(Request $request){
        // $post = Post::findOrFail($id);
        $post['id'] = 1;

        $content_id = 0;
        $result_array = array();

        if(isset($_POST)){
            $content_id = 1;
            // $result = $_POST['result'];
            foreach($_POST as $key => $value) {
                $result_array[$key] = $value;
                if($key === 'content_id'){
                    $content_id = $value;
                }
            }
        }

        $cid = $request->input('content_id');
        $date = $request->input('date');
        $user_id = $request->input('user');
        // $cid = 1;

        if($cid){
            // スケジュールを取得
            $schedules = Schedule::where('id',$cid)->get();
        }

        $id = 1;

        if($schedules){
            return view('schedule.create')->with([
                "id" => $id,
                // "content_id" => $content_id
                "result_array" => $result_array,
                "cid" => $cid,
                "schedules" => $schedules,
                "date" => $date,
                "user" => $user_id
                // "user" => $user,
             ]);
        }else{
            return view('schedule.create')->with([
                "id" => $id,
                // "content_id" => $content_id
                "result_array" => $result_array,
                "cid" => $cid
                // "user" => $user,
             ]);
        }
        
        // return view('schedule.create');
    }

    public function insert(Request $request){

        // var_dump($request->input('start-time'));
        // var_dump($request->input('end-time'));

        $type_array = [
                        "yotei" => 1,
                        "ziseki" => 2,
        ];
                            
        $date = $request->input('date');

        $schedule_array = [
            // 'id' => 4,
            // 'content_id' => 4,
            // 'from_time' => date('Y-m-d'). " ". $request->input('start-time').':00',
            // 'to_time' => date('Y-m-d'). " ". $request->input('end-time').':00',
            'date'          => $date,
            'user_id'       => '1',                                     //test用user
            'from_time'     => $request->input('start-time').':00',
            'to_time'       => $request->input('end-time').':00',
            'title'         => $request->input('title'),
            'text'          => $request->input('naiyo'),
            'type'          =>$type_array[$request->input('type')],
            // 'comment' => 'test'

        ];

        // $content_array = [
        //     // 'id' => 4,
        //     'title' => 'test',
        //     'text' => $request->input('start-time'),
        //     'comment' => 'test'

        // ];

        // $dayschedule = DaySchedule::create([
        //                                     'id' => '1',
        //                                     'from_time' => date('Y-m-d'). " ". $request->input('start-time').':00',
        //                                     'to_time' => date('Y-m-d'). " ". $request->input('end-time').':00',
        //                                     'content_id' => '1',
        //                                     ]);
        $ds1 = new Schedule($schedule_array);
        $ds1->save();
        // $ds1->contents()->create($content_array);

        // 選択した日付へ飛ばす
        return view('schedule.index');
    }

    public function change(Request $request){

        // var_dump($request->input('start-time'));
        // var_dump($request->input('end-time'));

        // $type_array = [
        //                 "yotei" => 1,
        //                 "ziseki" => 2,
        // ];
                            
        // $date = $request->input('date');

        $id = $request->input('schedule_id');

        $date = $request->input('date');
        $user_id = $request->input('user_id');

        $schedule_array = [
            // 'id' => 4,
            // 'content_id' => 4,
            // 'from_time' => date('Y-m-d'). " ". $request->input('start-time').':00',
            // 'to_time' => date('Y-m-d'). " ". $request->input('end-time').':00',
            // 'date'          => $date,
            // 'user_id'       => '1',                                     //test用user
            'from_time'     => $request->input('start-time').':00',
            'to_time'       => $request->input('end-time').':00',
            'title'         => $request->input('title'),
            'text'          => $request->input('text'),
            // 'type'          =>$type_array[$request->input('type')],
            // 'comment' => 'test'

        ];

        // $content_array = [
        //     // 'id' => 4,
        //     'title' => 'test',
        //     'text' => $request->input('start-time'),
        //     'comment' => 'test'

        // ];

        // $dayschedule = DaySchedule::create([
        //                                     'id' => '1',
        //                                     'from_time' => date('Y-m-d'). " ". $request->input('start-time').':00',
        //                                     'to_time' => date('Y-m-d'). " ". $request->input('end-time').':00',
        //                                     'content_id' => '1',
        //                                     ]);
        // $ds1 = new Schedule($schedule_array);
        // $ds1->save();
        // $ds1->contents()->create($content_array);

        Schedule::where('id', $id)->update($schedule_array);

        // 選択した日付へ飛ばす
        // return view('schedule.index');
        return redirect('/schedule?date='. $date .'&user=' .$user_id);
    }

    public function delete(Request $request){

        // var_dump($request->input('start-time'));
        // var_dump($request->input('end-time'));

        // $type_array = [
        //                 "yotei" => 1,
        //                 "ziseki" => 2,
        // ];
                            
        // $date = $request->input('date');

        $id = $request->input('schedule_id');

        $date = $request->input('date');
        $user_id = $request->input('user_id');

        $schedule_array = [
            // 'id' => 4,
            // 'content_id' => 4,
            // 'from_time' => date('Y-m-d'). " ". $request->input('start-time').':00',
            // 'to_time' => date('Y-m-d'). " ". $request->input('end-time').':00',
            // 'date'          => $date,
            // 'user_id'       => '1',                                     //test用user
            // 'from_time'     => $request->input('start-time').':00',
            // 'to_time'       => $request->input('end-time').':00',
            // 'title'         => $request->input('title'),
            // 'text'          => $request->input('text'),
            'del_flg'          => 1,
            // 'type'          =>$type_array[$request->input('type')],
            // 'comment' => 'test'

        ];

        // $content_array = [
        //     // 'id' => 4,
        //     'title' => 'test',
        //     'text' => $request->input('start-time'),
        //     'comment' => 'test'

        // ];

        // $dayschedule = DaySchedule::create([
        //                                     'id' => '1',
        //                                     'from_time' => date('Y-m-d'). " ". $request->input('start-time').':00',
        //                                     'to_time' => date('Y-m-d'). " ". $request->input('end-time').':00',
        //                                     'content_id' => '1',
        //                                     ]);
        // $ds1 = new Schedule($schedule_array);
        // $ds1->save();
        // $ds1->contents()->create($content_array);

        Schedule::where('id', $id)->update($schedule_array);

        // 選択した日付へ飛ばす
        // return view('schedule.index');
        return redirect('/schedule?date='. $date .'&user=' .$user_id);
    }

    /**
     * CSV出力
     */
    public function outputcsv(){
        $fp = fopen('php://output', 'w');

        $file_name = 'analyst' . date('Ymd') . '.csv';

        // $analyst = new Analyst();
    //     // $result = DaySchedule::with('contents')->find(1)->toArray();
        
        // var_dump($result);
        $user_id = 0;   //初期値は誰でないuser

        if(isset($_POST)){
            // $result = $_POST['result'];
            foreach($_POST as $key => $value) {
                if($key === 'user_id'){
                    $user_id = $value;
                }
            }
        }

        // $result = Analyst::where('user_id',$user_id)->first()->toArray();
        $result = Analyst::where('user_id',$user_id)->get()->toArray();
        var_dump($result);
        // $data = array (
        //     array('aaa', 'bbb', 'ccc', 'dddd'),
        //     array('123', '456', '789'),
        //     array('"aaa"', '"bbb"')
        // );

        // foreach ($data as $row) {
        //     fputcsv($fp, $row, ',', '"');
        // }
        fputcsv($fp, $result[0], ',', '"');
        fclose($fp);
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename={$file_name}");
        header('Content-Transfer-Encoding: binary');

        
        exit;

        return view('schedule.create');
    }
}
