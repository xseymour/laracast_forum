<?php

namespace Tests\Feature;

use App\Model\Thread;
use App\Model\User;
use Tests\DatabaseTestCase;

class CreateThreadsTest extends DatabaseTestCase
{
    /**
     * @test
     */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        //given an authenticated user
        $user = factory(User::class)->create();
        $this->actingAs($user);
        //and a new thread
        $thread = factory(Thread::class)->make(['user_id' => auth()->id()]);
        //when said user hits enpoint to submit a new thread
        $this->post('/threads', $thread->toArray());
        //when viewing all threads we should now see the created thread
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    function guests_cannot_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = factory(Thread::class)->make();
        //when said user hits enpoint to submit a new thread
        $this->post('/threads', $thread->toArray());
    }
}
