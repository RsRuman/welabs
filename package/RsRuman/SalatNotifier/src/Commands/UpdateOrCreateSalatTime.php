<?php

namespace RsRuman\SalatNotifier\Commands;

use AllowDynamicProperties;
use Illuminate\Console\Command;
use RsRuman\SalatNotifier\Interfaces\SalatTimeInterface;

#[AllowDynamicProperties]
class UpdateOrCreateSalatTime extends Command
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
    protected $signature = 'generate:salat_time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update or create salat time';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $fajr    = $this->ask('Enter FAJR time (in HH:MM format)');
        $dhuhr   = $this->ask('Enter DHUHR time (in HH:MM format)');
        $asr     = $this->ask('Enter ASR time (in HH:MM format)');
        $maghrib = $this->ask('Enter MAGHRIB time (in HH:MM format)');
        $isha    = $this->ask('Enter ISHA time (in HH:MM format)');

        $times = compact('fajr', 'dhuhr', 'asr', 'maghrib', 'isha');

        foreach ($times as $key => $time) {
            if (!$this->isValidTimeFormat($time)) {
                $this->error("Invalid time format for {$key}: {$time}. Please use HH:MM format.");
                return;
            }
        }

        $this->salatTimeRepository->storeSalatTimes($times);

        $this->info('Salat times updated successfully.');
    }

    /**
     * Validate the time format.
     *
     * @param string $time
     * @return bool
     */
    protected function isValidTimeFormat(string $time): bool
    {
        return preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $time);
    }
}
