<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\DaySchedule;
use App\Content;
use Illuminate\Support\Facades\DB;

class DayScheduleTest extends TestCase
{
    use DatabaseTransactions;

    private $attributes;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function setUp(): void
    {
        parent::setUp();

        // $this->attributes = [
        //     'id'            => '1',
        //     'from_time'     => '2020-03-01 17:00:00',
        //     'to_time'       => '2020-03-01 18:00:00',
        //     'content_id'    => '1',
        //     'created'       => '2020-03-01 17:00:00',
        //     'modified'      => '2020-03-01 17:00:00'
        // ];
    }

    public function testInsertTest(){
        // $this->attributes = [
        //     'id' => 1,
        //     'title' => 'test', 
        //     'text' => 'テスト用のテキスト',
        //     'comment' => 'テスト用のコメント',
        //     'type' => 1,
        //     'del_flg' => 0
        // ];
        
        // Content::create($this->attributes);
        // $content = new Content();
        // $content->id = 1;
        // $content->save();

        // $this->assertDatabaseHas('contents', $this->attributes);

        $this->attributes = [
            'id'            => '1',
            'from_time'     => '2020-03-01 17:00:00',
            'to_time'       => '2020-03-01 18:00:00',
            'content_id'    => '1',
        ];
        DaySchedule::create($this->attributes);
        $this->assertDatabaseHas('day_schedules', $this->attributes);
    }

    public function testSotuDaySchedule(){
        $response = $this->get('/dayschedule');

        $response->assertStatus(200);
    }

    // ポストした時のレスポンス検証用テスト？
    // https://qiita.com/grohiro/items/4efc6c569be26e36aef2
    // public function testStore()
    // {
    //     $data = [ # 登録用のデータ
    //         'user' => [
    //             'start-time' => '23:00',
    //             'ened-time' => '00:00',
    //             'naiyo' => 'サンプルスケジュール',
    //         ],
    //     ];

    //     // POST リクエスト
    //     $response = $this->post(route('dayschedule.create'), $data);

    //     // レスポンス検証
    //     $response->assertOk() # ステータスコードが 200
    //         ->assertJsonFragment([ # レスポンス JSON に以下の値を含む
    //             'start-time' => '23:00',
    //             'ened-time' => '00:00',
    //             'naiyo' => 'サンプルスケジュール',
    //         ]);

    // }

    // ポストしたときにデータが登録されるかテスト
    public function test_a_dayschedule_can_be_added(){
        // $content = new Content();
        // $content->id = 1;
        // $content->save();

        $this->withoutExceptionHandling();//エラーが起きても例外処理をしない
        $this->post('/dayschedule/insert', [
                                            'start-time'=>'09:00',
                                            'end-time' =>'10:00',
                                            'naiyo' => 'test schedule'
                                            ]);
        $this->assertCount(1, DaySchedule::all());
    }

    /**
     * 1日のコンテンツ（内容）を取得できるかテスト
     */
    public function testGetContentsByDay(){
        // 確認に必要なパラメータ
        $id                     = 100000;
        $from_time              = "2020-03-21 11:00:00";
        $to_time                = "2020-03-21 12:00:00";
        $title                  = "test title";
        $text                   = "test text";
        $comment                = "test comment";

        $result_hikaku_array = [
                                    'id' => $id,
                                    'from_time' => $from_time,
                                    'to_time' => $to_time,
                                    'title' => $title,
                                    'text' => $text,
                                    'comment' => $comment
        ];

        $daySchedule = new DaySchedule();
        $daySchedule->id = 1;
        $daySchedule->content_id = $id;
        $daySchedule->from_time = $from_time;
        $daySchedule->to_time = $to_time;
        $daySchedule->save();

        
        $content = new Content();
        $content->id = $id;
        $content->title = $title;
        $content->text = $text;
        $content->comment = $comment;
        $content->save();

        $daySchedule = new DaySchedule();
        $result = $daySchedule->select(['contents.id','from_time','to_time','title','text','comment'])
                              ->join('contents','day_schedules.content_id','=','contents.id')
                              ->get()
                              ->toArray();

        $this->assertEquals($result_hikaku_array,$result[0]);
    }

    /** 1日のスケジュールを取得できるかをリレーションで確認 */
    public function testGetContentsByDayByRelation(){
        // 確認に必要なパラメータ
        $id                     = 100000;
        $from_time              = "2020-03-21 11:00:00";
        $to_time                = "2020-03-21 12:00:00";
        $title                  = "test title";
        $text                   = "test text";
        $comment                = "test comment";

        $day_schedule_array = [
                                'id' => 1,
                                'content_id' => $id,
                                'from_time' => $from_time,
                                'to_time' => $to_time,

        ];

        $content_array = [
                                'id' => $id,
                                'title' => $title,
                                'text' => $text,
                                'comment' => $comment

        ];


        // $daySchedule = new DaySchedule();
        // $daySchedule->id = 1;
        // $daySchedule->content_id = $id;
        // $daySchedule->from_time = $from_time;
        // $daySchedule->to_time = $to_time;
        // $daySchedule->save();

        
        // $content = new Content();
        // $content->id = $id;
        // $content->title = $title;
        // $content->text = $text;
        // $content->comment = $comment;
        // $content->save();

        $ds1 = new DaySchedule($day_schedule_array);
        $ds1->save();
        $ds1->contents()->create($content_array);

        DB::enableQueryLog();

        $daySchedule = new DaySchedule();
        $result = DaySchedule::with('contents')->find(1)->toArray();

        // dumpする
        // var_dump(DB::getQueryLog());

        // foreach($result as $r){
        //     var_dump($r);
        // }
        
        // var_dump($result['contents']);

        // 便宜的にfrom_timeとtitleの値をテストしている（あとで変更するかも）
        $this->assertEquals("2020-03-21 11:00:00", $result['from_time']);
        $this->assertEquals("test title", $result['contents']['title']);
    }
}
