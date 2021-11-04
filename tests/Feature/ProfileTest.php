<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;


    /** @test */

    public function a_user_has_a_profile()
    {
        $this->withoutExceptionHandling();
        $user = create(User::class);
        $this->be($user);
        $this->get("/profiles/{$user->name}")->assertSee($user->name);
    }

    /** @test */

    public function a_user_profile_displays_user_threads()
    {

        $user = create(User::class);
        $this->be($user);

        $thread = create(Thread::class,['user_id'=>$user->id]);

        $this->get("/profiles/{$user->name}")->assertSee($thread->title);

    }
}
