<?php

namespace RsRuman\SalatNotifier\Commands;

use AllowDynamicProperties;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use RsRuman\SalatNotifier\Interfaces\SalatTimeInterface;
use RsRuman\SalatNotifier\Jobs\SendSalatJob;
use RsRuman\SalatNotifier\Notifications\SalatNotification;

#[AllowDynamicProperties]
class SalatNotify extends Command
{
    public function __construct(SalatTimeInterface $salatTimeRepository)
    {
        parent::__construct();
        $this->salatTimeRepository = $salatTimeRepository;
    }

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
    protected $description = 'Notify 10 minutes before each Salat time';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $salats = [
            'Fajr'    => $this->salatTimeRepository->getFajrTime(),
            'Dhuhr'   => $this->salatTimeRepository->getDhuhrTime(),
            'Asr'     => $this->salatTimeRepository->getAsrTime(),
            'Maghrib' => $this->salatTimeRepository->getMaghribTime(),
            'Isha'    => $this->salatTimeRepository->getIshaTime(),
        ];

        foreach ($salats as $name => $time) {
            $this->scheduleNotification($name, $time);
        }
    }

    /**
     * Schedule a notification for a given Salat.
     *
     * @param string $name
     * @param string $time
     */
    protected function scheduleNotification(string $name, string $time): void
    {
        // Calculate the notification time
        $notificationTime = Carbon::createFromFormat('H:i:s', $time.':00')->subMinutes(10);

        // Check if the notification should be sent now
        if (Carbon::now()->format('H:i:s') === $notificationTime->format('H:i:s')) {
            $this->info("Sending notification for {$name}.");
            $this->notifyAt($name, $time);
        }
    }

    /**
     * Handle the notification logic.
     *
     * @param string $name
     * @param string $time
     */
    protected function notifyAt(string $name, string $time): void
    {
        $notificationTime = Carbon::createFromFormat('H:i:s', $time.':00')->subMinutes(10);

        // Dispatch job to be handled at the calculated time
        SendSalatJob::dispatch($name, $time)
            ->delay($notificationTime);
    }
}
