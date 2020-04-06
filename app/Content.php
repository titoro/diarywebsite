<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    //
    /**
     * create()やupdate()で入力を受け付ける ホワイトリスト
     */
    protected $fillable = [ 'id',
                            'title', 
                            'text',
                            'comment',
                            'type',
                            'del_flg',
                            'created',
                            'modified'];

    // or

    /**
     * create()やupdate()で入力させない ブラックリスト
     */
    // protected $guarded = ['id'];
}
