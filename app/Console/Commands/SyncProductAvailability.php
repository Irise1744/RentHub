<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;

class SyncProductAvailability extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:sync-availability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync product availability: mark rented products as available once their rental period ends.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $now = Carbon::now();

        $query = Product::where('rental_status', 'rented')
            ->whereNotNull('available_to')
            ->where('available_to', '<=', $now)
            ->get();

        $count = 0;
        foreach ($query as $product) {
            $product->update([
                'rental_status' => 'available',
                
                'available_from' => null,
                'available_to' => null,
            ]);
            $count++;
        }

        $this->info("Products updated: {$count}");

        return 0;
    }
}
