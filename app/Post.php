<?php

namespace App;

class Post extends Model
{
    protected $fillable = ['title', 'body']; // fields that are allowed to submit
//    protected $guarded = ['user_id'];        // fields that are forbidden to submit

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
