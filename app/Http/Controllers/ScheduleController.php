<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Content;
use App\Analyst;

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
        $schedules = Schedule::where('date',$date)->where('user_id',1)->where('type',1)->orderBy('from_time')->get();

        $zisekis = Schedule::where('date',$date)->where('user_id',1)->where('type',2)->orderBy('from_time')->get();

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
                        "result" => $result,
                        "schedules" => $schedules,
                        "zisekis" => $zisekis,
            ]);
        }else{
            return view('schedule.index');
        }
    }

    public function create(){
        // $post = Post::findOrFail($id);
        $post['id'] = 1;

        $id = 1;
        return view('schedule.create')->with([
            "id" => $id
            // "user" => $user,
         ]);
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

    /**
     * CSV出力
     */
    public function outputcsv(){
        $fp = fopen('php://output', 'w');

        $file_name = 'sample.csv';

        // $analyst = new Analyst();
    //     // $result = DaySchedule::with('contents')->find(1)->toArray();
        $result = Analyst::where('user_id',1)->first()->toArray();

        // var_dump($result);

        $data = array (
            array('aaa', 'bbb', 'ccc', 'dddd'),
            array('123', '456', '789'),
            array('"aaa"', '"bbb"')
        );

        // foreach ($data as $row) {
        //     fputcsv($fp, $row, ',', '"');
        // }
        fputcsv($fp, $result, ',', '"');
        fclose($fp);
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename={$file_name}");
        header('Content-Transfer-Encoding: binary');

        
        exit;

        return view('schedule.create');
    }
}
