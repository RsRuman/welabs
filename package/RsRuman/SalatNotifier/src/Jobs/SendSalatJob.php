<?php

namespace RsRuman\SalatNotifier\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use RsRuman\SalatNotifier\Notifications\SalatNotification;
use Illuminate\Support\Facades\Notification;

class SendSalatJob implements ShouldQueue
{
    use Queueable;

    protected string $name;
    protected string $time;

    /**
     * Create a new job instance.
     */
    public function __construct(string $name, string $time)
    {
        $this->name = $name;
        $this->time = $time;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::route('slack', env('SLACK_BOT_USER_DEFAULT_CHANNEL'))->notify(new SalatNotification($this->name, $this->time));
    }
}
