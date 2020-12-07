<?php

namespace Tests\Feature;

use App\EmailList;
use App\Emails;
use App\MessageTemplate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListsCreateTest extends TestCase
{
    use RefreshDatabase;

        /** @test */
        function guest_may_not_create_list()
        {
    
            $this->post(route('list.store'))
                ->assertRedirect('/login');
    
            $this->get(route('list.store'))
                ->assertRedirect('/login');
        }

        
         /** @test */
    function an_authenticated_user_can_create_new_list()
    {
        $this->withoutExceptionHandling();


        $this->signIn();

        $list = factory(EmailList::class)->make();

        $response = $this->post(route('list.store'), $list->toArray());

        //it will return url of just created emailList
        $this->get($response->headers->get('Location'))
            ->assertSee($list->title)
            ->assertSee($list->body);
    }


        /** @test */
    function an_emailList_requires_a_title()
    {
        $this->publishList(['title' => null])
            ->assertSessionHasErrors('title');
    }



    /** @test */
    public function an_emailList_can_be_deleted()
    {
        $user = $this->signIn();

        $list = factory(EmailList::class)->create(['user_id' => $user->id]);
        $email = factory(Emails::class)->create(['email_list_id' => $list->id]);

        $response = $this->json('DELETE', '/lists/'.$list->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('email_lists', ['id' => $list->id]);
        $this->assertDatabaseMissing('emails', ['id' => $email->id]);

    }

        /** @test */
        public function unautherized_users_may_not_delete_list()
        {
            $list = factory(EmailList::class)->create();
    
            $this->delete('/lists/'.$list->id)->assertRedirect('/login');
    
            $this->signIn();
    
            $this->delete('/lists/'.$list->id)->assertStatus(403);
    
        }


            /** @test */
        public function only_the_owner_can_update_the_list()
        {
            $this->signIn();
            $list = factory(EmailList::class)->create();
            $this->patch('/lists/'.$list->id, [
                'title'=>'changed'
            ])->assertStatus(403);

            $this->assertNotEquals('changed', $list->title);
        }


             /** @test */
        public function only_the_owner_can_add_emails()
        {
            $list = factory(EmailList::class)->create();

            $this->signIn();

            $this->post(route('email.store', $list), [
                'email'=>'tadadsds@mail.ru'
            ])->assertStatus(403);
        }


        /** @test */
        public function only_the_owner_can_update_emails()
        {
            
            $list = factory(EmailList::class)->create();

            $email = factory(Emails::class)->create(['email_list_id'=>$list->id]);

            $this->signIn();

            $this->patch(route('email.update', $email), [
                'email' => 'new@email.ru'
            ])->assertStatus(403);            

        }


        /** @test */
        public function the_owner_can_update_emails()
        {
            
            $user = factory(User::class)->create();

            $list = factory(EmailList::class)->create(['user_id'=>$user->id]);

            $email = factory(Emails::class)->create(['email_list_id'=>$list->id]);

            $this->signIn($user);

            $this->patch(route('email.update', $email), [
                'email' => 'new@email.ru'
            ]);
            
            $this->assertEquals('new@email.ru', $email->fresh()->email);

        }

             
        public function publishList($overrides = [])
        {
            $this->signIn();

            $list = factory(EmailList::class)->make($overrides);

            return $this->post(route('list.store'), $list->toArray());
        }
}
