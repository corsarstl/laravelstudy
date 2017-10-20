<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body']; // fields that are allowed to submit
//    protected $guarded = ['user_id'];        // fields that are forbidden to submit
}
