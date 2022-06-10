<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemoveExpiredOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:expired-otps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired otps';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $otps = \App\Models\Otp::where('expired_at', '<', now())->get();
        if ($otps->count() > 0) {
            $otps->each(function ($otp) {
                $otp->delete();
            });
            $this->info("Expired otps removed");
        } else {
            $this->info('No expired otp found');
        }
    }
}
