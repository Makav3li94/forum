<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->thread = Thread::factory()->create();
    }

    /** @test */

    public function a_user_can_view_threads()
    {

        $response = $this->get('/threads');

        $response->assertStatus(200);
        $response->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_view_a_thread()
    {


        $response = $this->get($this->thread->path());
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_of_a_thread()
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);

        $response = $this->get($this->thread->path());

        $response->assertSee($reply->body);

    }

    /** @test */
    public function a_user_can_filter_threads_by_tag()
    {
        $user = User::factory()->create();
        $this->be($user);

        $channel = Channel::factory()->create();
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);
        $this->get("/threads/" . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);

    }

    /** @test */
    function a_user_can_filter_his_or_her_threads(){
        $user = User::factory()->create();
        $this->be($user);

        $thread = create(Thread::class,['user_id'=> $user->id]);
        $otherThread = create(Thread::class);

        $this->get("/threads?by={$user->name}")
            ->assertSee($thread->title)
            ->assertDontSee($otherThread->title);

    }
}
