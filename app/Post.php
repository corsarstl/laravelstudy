<?php

namespace App;

use Carbon\Carbon;

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
        return $this->belongsTo(User::class);
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

    public function scopeFilter($query, $filters)
    {
        if ($month = $filters['month']) {
            $query->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if ($year = $filters['year']) {
            $query->whereYear('created_at', $year);
        }
    }
}
