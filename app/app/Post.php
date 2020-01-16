<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'user_id', 'text', 'media',
    ];

    public function usuario(){
        return $this->belongsTo('User');
    }
}
