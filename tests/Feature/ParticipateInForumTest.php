<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /**    @test */
    function a_authenticated_user_may_participate_in_forun_threads()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->be($user);

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make();
        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    function a_reply_required_a_body()
    {
        $user = User::factory()->create();
        $this->be($user);

        $reply = Reply::factory()->make(['body'=>null]);
        $thread = Thread::factory()->create();
        $this->post($thread->path() . '/replies', $reply->toArray())->assertSessionHasErrors('body');

    }
}
