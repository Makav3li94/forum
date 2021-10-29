<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guest_can_not_create_a_thread()
    {
        $this->withExceptionHandling();

        $this->get('/threads/create')->assertRedirect('/login');

        $thread = make(Thread::class);

        $this->post('/threads/', $thread->toArray())->assertStatus(302);
    }

    /** @test */
    function an_auth_user_can_create_a_thread()
    {
        $user = create(User::class);
        $this->be($user);

        $thread = Thread::factory()->make();

        $this->post('/threads/', $thread->toArray());


        $this->get($thread->path())->assertSee($thread->title);
    }

    /** @test */

    function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null]);

    }

    /** @test */
    function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null]);

    }

    /** @test */
    function a_thread_requires_a_channel()
    {
        $this->publishThread(['channel_id' => null]);

    }


    function publishThread($overrides = [])
    {
        $user = create(User::class);
        $this->be($user);

        $thread = Thread::factory()->make($overrides);

        $this->post('/threads', $thread->toArray())->assertSessionHasErrors(array_key_first($overrides));

    }
}



