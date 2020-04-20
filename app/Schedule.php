<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // protected $visible = ['id', 'content_id'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    //
    /**
     * create()やupdate()で入力を受け付ける ホワイトリスト
     */

    // guardedを使用するようにする
    // protected $fillable = [ 'id',
    //                         'date',
    //                         'from_time', 
    //                         'to_time',
    //                         'content_id',
    //                         'created',
    //                         'modified'
    // ];

    protected $guarded = [ 'id',
    ];

    // protected $guarded = [
    //                         'id',
    // ];

    // or

    /**
     * create()やupdate()で入力させない ブラックリスト
     */
    // protected $guarded = ['id'];

    Public function contents(){
        // ここhasOne?hasMany?
        // 考えたらhasOneのような気がしたのでhasOneにしている
        // return $this->hasOne('App\Content','id', 'content_id');
    }
}
