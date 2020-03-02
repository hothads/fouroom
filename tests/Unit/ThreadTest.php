<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	function a_thread_has_replies()
	{
		$thread = factory('App\Thread')->create();
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $thread->replies);
	}

		/** @test */
	function a_thread_has_a_creator()
	{
		$thread = factory('App\Thread')->create();

		$this->assertInstanceOf('App\User', $thread->creator);
		
	}


		/** @test */
	function a_thread_can_add_a_reply()
	{
		$thread = factory('App\Thread')->create();

		$thread->addReply([
			'body' => 'tada',
			'user_id' => 1
		]);

		$this->assertCount(1, $thread->replies);
		
	}

}
