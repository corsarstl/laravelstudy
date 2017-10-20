<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function scopeIncomplete($query)   // allows to do -  Task::incomplete();
    {
        return $query->where('completed', 0);
    }
}
