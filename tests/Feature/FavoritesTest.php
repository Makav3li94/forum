<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function guest_can_not_reply()
    {
        $this->post('replies/1/favorites')->assertRedirect('login');
    }

    /** @test */

    public function an_auth_user_can_favorite_any_reply()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->be($user);

        $reply = create(Reply::class);

        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }
    /** @test */
    public function an_auth_user_can_favorite_reply_once(){
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->be($user);

        $reply = create(Reply::class);

        try{
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        }catch (\Exception $e){
            $this->fail('You cant insert same record 2 times');
        }

        $this->assertCount(1, $reply->favorites);
    }

}
