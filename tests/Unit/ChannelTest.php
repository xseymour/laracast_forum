<?php

namespace Tests\Unit;

use App\Model\Channel;
use App\Model\Thread;
use Tests\DatabaseTestCase;

class ChannelTest extends DatabaseTestCase
{
    /** @test */
    function a_channel_has_threads()
    {
        $channel    = factory(Channel::class)->create();
        $thread     = factory(Thread::class)->create(['channel_id' => $channel->id]);
        self::assertTrue($channel->threads->contains($thread));
    }
}