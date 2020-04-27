<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analyst extends Model
{
    //// protected $visible = ['id', 'content_id'];
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
}
