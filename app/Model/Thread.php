<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Model\Thread
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Model\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Reply[] $replies
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Thread whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Thread whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Thread whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Thread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Thread whereUserId($value)
 * @mixin \Eloquent
 */
class Thread extends Model
{
    /**
     * Fetch a path to the current thread.
     *
     * @return string
     */
    public function path()
    {
        return '/threads/' . $this->id;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
