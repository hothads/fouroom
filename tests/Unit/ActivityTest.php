<?php

namespace Tests\Unit;

use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Thread;
use App\Activity;

class ActivityTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function it_records_activity_when_a_thread_is_created()
	{
		$this->signIn();

		$thread = factory(Thread::class)->create();
		$this->assertDatabaseHas('activities', [
			'type'=>'created_thread',
			'user_id'=>auth()->id(),
			'subject_id'=>$thread->id,
			'subject_type'=>'App\Thread'
		]);

		$activity = Activity::first();

		$this->assertEquals($activity->subject->id, $thread->id);
	}

	/** @test */
    public function it_records_activity_when_a_reply_is_created(){
        $this->signIn();

        $reply = factory(Reply::class)->create();

        $this->assertEquals(2, Activity::count());


    }


}
