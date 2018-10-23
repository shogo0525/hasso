<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'board_id', 'body', 'like_count'
    ];

    public function board()
    {
        return $this->belongsTo('App\Board');
    }
}
