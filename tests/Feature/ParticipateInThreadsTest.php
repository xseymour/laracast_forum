<?php

namespace Tests\Feature;

use App\Model\Reply;
use App\Model\Thread;
use App\Model\User;
use Tests\DatabaseTestCase;

class ParticipateInThreadsTest extends DatabaseTestCase
{

    /** @test */
    function guests_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/threads/1/replies', []);
    }

    /** @test */
    function authenticated_user_may_participate_in_forum_threads()
    {
        //Given we have an authenticated user
        $user   = $this->signIn();
        //And an existing thread
        /** @var Thread $thread */
        $thread = create(Thread::class);
        //When the user adds a reply to the thread via post
        /** @var Reply $reply */
        $reply  = make(Reply::class, ['thread_id' => $thread->id, 'user_id' => $user->id]);
        $this->post($thread->path().'/replies', $reply->toArray());
        //Then their reply should be visible on the page.
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
