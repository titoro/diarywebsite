<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    // DB真っさらにしてくれる。
    // テーブル毎消えるので、今はコメントアウトする
    // use RefreshDatabase;
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

    // public function testUsersTest(){
    //     $data = [
    //         'id' => 1,
    //         'name' => 'nanba',
    //         'email' => 'test@test.co.jp',
    //         'password' => 'aa'
    //     ];
    //     $this->assertDatabaseHas('users',$data);
    // }

    public function setUp(): void
    {
        parent::setUp();

        $this->attributes = [
            'name'     => 'テスト太郎',
            'email'     => 'hoge@example.com',
            // 'password' => bcrypt('test'),
        ];
    }

    public function testInsertTest(){
        User::create($this->attributes);
        $this->assertDatabaseHas('users', $this->attributes);
    }

}
