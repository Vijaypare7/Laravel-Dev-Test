<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LogProductCreation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductCreated $event): void
    {
        $date = now()->format('Y-m-d');
        $logFile = "logs/product-create-{$date}.log";

        $logDirectory = storage_path('logs');
        if (!File::isDirectory($logDirectory)) {
            File::makeDirectory($logDirectory, 0755, true);
        }

        $logFilePath = storage_path($logFile);

        $logMessage = 'Product created: ' . $event->product->name . ' at ' . now()->toDateTimeString();
        File::append($logFilePath, $logMessage . PHP_EOL);

        // Log::info('Product created: ' . $event->product->name . ' at ' . now());
    }
}
