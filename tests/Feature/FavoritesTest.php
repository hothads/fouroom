<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function guest_can_not_favorite()
    {
        $this->post('replies/1/favorites')->assertRedirect('login');    
    }



    /** @test */
    public function an_auth_user_can_favorite_any_reply()
    {

            $this->withoutExceptionHandling();

            $this->signIn();

            $reply = factory('App\Reply')->create();

            $this->post('replies/'. $reply->id . '/favorites');

            $this->assertCount(1, $reply->favorites);
    }


    /** @test */
    public function auth_user_can_favorite_reply_once()
    {
            $this->withoutExceptionHandling();

            $this->signIn();

            $reply = factory('App\Reply')->create();


            try {
                $this->post('replies/'. $reply->id . '/favorites');
                $this->post('replies/'. $reply->id . '/favorites');
            } catch (\Exception $e) {
                $this->fail('Did not expect to insert the same record set twice');
            }

            $this->assertCount(1, $reply->favorites);
    }
    
    
    
        
    
}