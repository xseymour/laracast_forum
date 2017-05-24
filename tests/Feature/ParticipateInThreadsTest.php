<?php

namespace Tests\Feature;

use App\Model\Reply;
use App\Model\Thread;
use App\Model\User;
use Tests\DatabaseTestCase;

class ParticipateInThreadsTest extends DatabaseTestCase
{

    /**
     * @var Thread
     */
    protected $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = create(Thread::class);
    }

    /** @test */
    function guests_may_not_add_replies()
    {
        $this->withExceptionHandling()
        ->post($this->thread->path().'/replies', [])
        ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_may_participate_in_forum_threads()
    {
        //Given we have an authenticated user
        $this->signIn();
        //And an existing thread, When the user adds a reply to the thread via post endpoint
        /** @var Reply $reply */
        $reply  = make(Reply::class, ['thread_id' => $this->thread->id]);
        $this->post($this->thread->path().'/replies', $reply->toArray());
        //Then their reply should be visible on the page.
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        /** @var Thread $thread */
        $thread = create(Thread::class);
        $reply  = make(Reply::class, ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
             ->assertSessionHasErrors('body');
    }
}
