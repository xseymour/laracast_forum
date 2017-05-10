<?php

namespace Tests\Unit;

use App\Model\Reply;
use App\Model\Thread;
use App\Model\User;
use Tests\DatabaseTestCase;

class ReplyTest extends DatabaseTestCase
{

    /**
     * @var Reply
     */
    protected $reply;

    public function setUp()
    {
        parent::setUp();
        $this->reply = create(Reply::class);
    }

    /** @test */
    function it_has_an_owner()
    {
        $this->assertInstanceOf(User::class, $this->reply->owner);
    }

    /**
     * @test
     */
    function it_belongs_to_a_thread()
    {
        $this->assertInstanceOf(Thread::class, $this->reply->thread);
    }
}
