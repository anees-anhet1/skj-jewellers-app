<?php

namespace App\Console\Commands;

use App\Models\GoldRate;
use Illuminate\Console\Command;

class FetchGoldRate extends Command
{
    protected $signature = 'gold:fetch';

    protected $description = 'Automatically fetch and publish the latest gold rate (simulated live feed)';

    public function handle()
    {
        $last = GoldRate::latest()->first();

        // Start from the last known rate, or a sensible default if none exists yet
        $base24k = $last->rate_24k ?? 7200.00;
        $baseSilver = $last->rate_silver ?? 86.50;

        // Simulate a small realistic market movement (up or down by a small %)
        $change = rand(-50, 50) / 100; // -0.50% to +0.50%
        $new24k = round($base24k * (1 + $change / 100), 2);
        $new22k = round($new24k * 0.9167, 2); // 22K is ~91.67% purity of 24K
        $newSilver = round($baseSilver * (1 + $change / 100), 2);

        GoldRate::create([
            'rate_24k' => $new24k,
            'rate_22k' => $new22k,
            'rate_silver' => $newSilver,
            'source' => 'api',
        ]);

        $this->info("Gold rate updated automatically: 24K ₹{$new24k}, 22K ₹{$new22k}, Silver ₹{$newSilver}");
    }
}