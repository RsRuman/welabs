<?php

namespace RsRuman\SalatNotifier\Commands;

use Illuminate\Console\Command;

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
        $this->info('Hello World!');
    }
}
