<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;

class ApplyDiscountToOldProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:apply-discount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply a 30% discount to products older than one month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $oneDayAgo = Carbon::now()->subDay();
        $oneMonthAgo = Carbon::now()->subMonth();
        $products = Product::where('created_at', '<', $oneMonthAgo)->get();

        // Lệnh chạy thủ công  php artisan products:apply-discount

        foreach ($products as $product) {
            $product->discount = $product->price *(100-30)/100;
            $product->save();
        }

        $this->info('Discount applied to products older than one month.');

        return 0;
    }
}
