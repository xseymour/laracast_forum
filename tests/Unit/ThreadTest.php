<?php

namespace Tests\Unit;

use App\Model\Reply;
use App\Model\Thread;
use App\Model\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Thread
     */
    protected $thread;


    public function setUp()
    {
        parent::setUp();
        $this->thread = factory(Thread::class)->create();
    }

    /** @test */
    function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /**
     * @test
     */
    function a_thread_has_an_owner()
    {
        $this->assertInstanceOf(User::class, $this->thread->owner);
    }

    /**
     * @test
     */
    function a_thread_has_a_path()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body);
    }

    /**
     * @test
     */
    function a_thread_can_add_replies()
    {
        //Given a reply
        $reply = factory(Reply::class)->make();
        //assert use of addReply
        $this->thread->addReply($reply);
        $this->assertCount(1, $this->thread->replies);
    }
}
