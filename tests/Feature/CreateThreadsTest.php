<?php

namespace Tests\Feature;

use App\Model\Channel;
use App\Model\Thread;
use App\Model\User;
use Illuminate\Http\Response;
use Tests\DatabaseTestCase;

class CreateThreadsTest extends DatabaseTestCase
{

    /** @test */
    function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        //cannot see create page
        $this->get('/threads/create')
            ->assertRedirect('/login');

        //cannot manually post a new thread
        $this->post('/threads')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        //given an authenticated user
        $this->signIn();

        //and a new thread
        /** @var Thread $thread */
        $thread = make(Thread::class);
        //when said user hits enpoint to submit a new thread
        /** @var Response $response */
        $response = $this->post('/threads', $thread->toArray());
        //when viewing all threads we should now see the created thread
        $this->get($response->headers->get('location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    function a_thread_requires_a_valid_channel()
    {
        factory(Channel::class, 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make(Thread::class, $overrides);
        return $this->post('/threads', $thread->toArray());

    }

}
