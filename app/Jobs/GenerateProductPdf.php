<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Product;
use PDF;

class GenerateProductPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;

    /**
     * Create a new job instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $pdf = PDF::loadView('pdf.product', ['product' => $this->product]);

        $directory = storage_path('app/public/pdfs');
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $pdf->save($directory . '/' . $this->product->slug . '.pdf');
    }
}
