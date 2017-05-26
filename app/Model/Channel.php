<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Channel
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Thread[] $threads
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Channel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Channel whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Channel whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Channel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Channel extends Model
{
    protected $guarded = ['id'];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
