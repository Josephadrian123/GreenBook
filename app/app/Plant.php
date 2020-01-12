<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;

class Plant extends Model
{
    protected $table = 'plants';
    protected $fillable = [
        'user_id', 'name', 'media',
    ];

    public function usuario(){
        return $this->hasOne('User', 'id', 'user_id');
    }
}