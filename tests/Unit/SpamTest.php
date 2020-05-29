<?php

namespace Tests\Unit;

use App\Inspections\Spam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class SpamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */

    function it_checks_for_invalid_key_words()
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent reply here'));

        $this->expectException('Exception');

        $spam->detect('yahoo customer support');
    }

    /** @test */

    function it_checks_for_key_being_held_down()
    {
        $spam = new Spam();

        $this->expectException('Exception');

        $this->assertFalse($spam->detect('Hello world aaaaaaaaa'));

    }
}
