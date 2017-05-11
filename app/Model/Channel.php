<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = ['id'];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
