<?php

namespace Tests\Unit;

use App\Models\Activity;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->withoutExceptionHandling();
        $user = create(User::class);
        $this->be($user);

        $thread = create(Thread::class);

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => $user->id,
            'subject_id' => $thread->id,
            'subject_type' => Thread::class
        ]);
        $activity = Activity::first();

        $this->assertEquals($activity->subject->id,$thread->id);
    }
    /** @test */
    public function it_records_activity_when_a_reply_is_created(){
        $this->withoutExceptionHandling();
        $user = create(User::class);
        $this->be($user);

        $reply = create(Reply::class);
        $this->assertDatabaseHas('activities', [
            'type' => 'created_reply',
            'user_id' => $user->id,
            'subject_id' => $reply->id,
            'subject_type' => Reply::class
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id,$reply->id);

    }

}
