<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'board_id', 'body'
    ];

    public function board()
    {
        return $this->belongsTo('App\Board');
    }
}
