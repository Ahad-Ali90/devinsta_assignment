<?php

namespace App\Console\Commands;

use App\Models\AnalyticsData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportAnalyticsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-analytics-data';

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
        $files = ['google_analytics', 'microsoft_clarity', 'facebook', 'instagram', 'snapchat'];

        foreach ($files as $file) {
            $json = Storage::get("data/{$file}.json");
            $parsed = json_decode($json, true);

            AnalyticsData::create([
                'platform' => ucfirst(str_replace('_', ' ', $file)),
                'date' => now()->toDateString(),
                'data' => $parsed,
            ]);
        }

    }
}