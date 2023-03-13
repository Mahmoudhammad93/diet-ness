<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SubscriptionStarted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:started';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Started Subscription Status To Ended';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscriptions = Subscription::where('payment_status', 'paid')->where('id',2)->where('status', 'started')->get();
        $now = Carbon::parse(date("Y-m-d"));
        foreach ($subscriptions as $subscription) {
            $end_at = Carbon::parse($subscription->end_at);
            if($end_at < $now){
                Subscription::where('id', $subscription->id)->update([
                    'status' => 'ended'
                ]);
            }
        }
    }
}
