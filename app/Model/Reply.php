<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Reply
 *
 * @property int $id
 * @property int $thread_id
 * @property int $user_id
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Model\User $owner
 * @property-read \App\Model\Thread $thread
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Reply whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Reply whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Reply whereThreadId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Reply whereUserId($value)
 * @mixin \Eloquent
 */
class Reply extends Model
{
    protected $guarded = ['id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
