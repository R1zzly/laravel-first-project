<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckSubscriptionExpiry extends Command
{
    protected $signature = 'subscriptions:check-expiry';

    protected $description = 'Check and update expired subscriptions';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $subscriptions = Subscription::where('status', 'active')
            ->where('expires_at', '<=', Carbon::now())
            ->get();

        foreach ($subscriptions as $subscription) {
            $subscription->update(['status' => 'expired']);
            // Notify the user if needed
            // $subscription->user->notify(new SubscriptionExpiredNotification());
        }

        $this->info('Expired subscriptions have been updated.');
    }
}
