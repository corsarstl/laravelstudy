<?php

namespace App;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'body']; // fields that are allowed to submit
//    protected $guarded = ['user_id'];        // fields that are forbidden to submit

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function addComment($body)
    {
        $this->comments()->create(compact('body'));
/*
        Comment::create([
            'body'      => request('body'),
            'post_id'   => $this->id
        ]);
*/
    }


}
