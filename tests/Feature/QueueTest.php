<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Jobs\SendAnswerEmail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Answer;

class QueueTest extends TestCase
{
    public function testAnswerEmailQueue()
    {
        //Fake the queue
        Queue::fake();
        $Answer = Answer::findOrFail( rand(1,20) );

        //Push a job
        SendAnswerEmail::dispatch($Answer);

        //// Assert the job was pushed to the queue

        Queue::assertPushed(SendAnswerEmail::class);
    }
}