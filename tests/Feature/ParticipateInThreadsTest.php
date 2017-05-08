<?php

namespace Tests\Feature;

use App\Model\Reply;
use App\Model\Thread;
use App\Model\User;
use Tests\DatabaseTestCase;

class ParticipateInThreadsTest extends DatabaseTestCase
{

    /** @test */
    function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/threads/1/replies', []);
    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads()
    {
        //Given we have an authenticated user
        $user   = factory(User::class)->create();
        $this->be($user);
        //And an existing thread
        /** @var Thread $thread */
        $thread = factory(Thread::class)->create();
        //When the user adds a reply to the thread via post
        /** @var Reply $reply */
        $reply  = factory(Reply::class)->make(['thread_id' => $thread->id, 'user_id' => $user->id]);
        $this->post($thread->path().'/replies', $reply->toArray());
        //Then their reply should be visible on the page.
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
