<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuestionAnswered;
use App\Answer;
use Log;

class SendAnswerEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $Answer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Answer $Answer)
    {
        $this->Answer = $Answer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Allow only 2 emails every 1 second
        Redis::throttle('my-mailtrap')->allow(2)->every(1)->then(function () {
        $recipient = 'steven@example.com';
        Mail::to($recipient)->send(new QuestionAnswered($this->Answer));
        Log::info('Emailed new answer ' . $this->Answer->id);
        }, function () {
            // Could not obtain lock; this job will be re-queued
            return $this->release(2);
        });
    }
}
