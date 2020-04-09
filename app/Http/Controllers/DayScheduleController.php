<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DaySchedule;
use App\Content;

class DayScheduleController extends Controller
{
    public function index () 
    {
        $hello = 'Hello,World!';
        $hello_array = ['Hello', 'こんにちは', 'ニーハオ'];

        // 1日のスケジュールを全て取得
        $daySchedule = new DaySchedule();
        // $result = DaySchedule::with('contents')->find(1)->toArray();
        $day_schedules = DaySchedule::with('contents')->where('date','2020-04-08')->orderBy('from_time')->get();
        // var_dump($day_schedules);

        return view('dayschedule.index', compact('day_schedules', 'day_schedules'));
    }

    public function create(){
        // $post = Post::findOrFail($id);
        $post['id'] = 1;
        return view('dayschedule.create');
    }

    public function insert(Request $request){

        var_dump($request->input('start-time'));
        var_dump($request->input('end-time'));

        $day_schedule_array = [
            'id' => 4,
            'content_id' => 4,
            'from_time' => date('Y-m-d'). " ". $request->input('start-time').':00',
            'to_time' => date('Y-m-d'). " ". $request->input('end-time').':00',

        ];

        $content_array = [
            'id' => 4,
            'title' => 'test',
            'text' => $request->input('start-time'),
            'comment' => 'test'

        ];

        // $dayschedule = DaySchedule::create([
        //                                     'id' => '1',
        //                                     'from_time' => date('Y-m-d'). " ". $request->input('start-time').':00',
        //                                     'to_time' => date('Y-m-d'). " ". $request->input('end-time').':00',
        //                                     'content_id' => '1',
        //                                     ]);

        $ds1 = new DaySchedule($day_schedule_array);
        $ds1->save();
        $ds1->contents()->create($content_array);

        return view('dayschedule.create');
    }


}
