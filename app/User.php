<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    /**
     * create()やupdate()で入力を受け付ける ホワイトリスト
     */
    protected $fillable = ['name', 'email','password'];

    // or

    /**
     * create()やupdate()で入力させない ブラックリスト
     */
    protected $guarded = ['id'];
}
