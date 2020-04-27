<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
// class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

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
