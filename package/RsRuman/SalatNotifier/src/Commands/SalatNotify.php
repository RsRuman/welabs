<?php

namespace RsRuman\SalatNotifier\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use RsRuman\SalatNotifier\Notifications\SalatNotification;

class SalatNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salat:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Notification::route('slack', env('SLACK_BOT_USER_DEFAULT_CHANNEL'))->notify(new SalatNotification());
        $this->info('Hello World!');
    }
}
