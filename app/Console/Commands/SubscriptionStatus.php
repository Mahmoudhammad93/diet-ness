<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SubscriptionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Pending Subscription Status To Start';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscriptions = Subscription::where('payment_status', 'paid')->where('status', 'pending')->get();
        $now = Carbon::parse(date("Y-m-d"));
        foreach ($subscriptions as $subscription) {
            $start_at = Carbon::parse($subscription->start_at);
            if ($now >= $start_at) {
                Subscription::where('id', $subscription->id)->update([
                    'status' => 'started'
                ]);
            }
        }
    }
}
